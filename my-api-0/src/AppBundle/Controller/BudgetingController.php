<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\Budget;
use AppBundle\Entity\Training;

/**
 * This controller was designed for interact with an API dedicated to the creation of budget requests 
 */
class BudgetingController extends FOSRestController
{
 
    private $status = ['pendiente', 'publicada', 'descartada']; // Different budget status
	public $page_size = 5; //Max size of budgeting for each page
	private $percent_approved = 50; // Percent limit from a category fine to be shown
	private $host = '/api/budget';
	private $parameters = array(
		'budgeting' => array(
			'primary' => 'id',
			'unrequired' => array('title', 'category'),
			'required' => array('description', 'email', 'phonenum', 'address'),
			'is_pending' => array('title', 'category', 'description'),
			'all' => array('id', 'title', 'category', 'description', 'email', 'phonenum', 'address'),
		),
	);


	// Routed

    /**
     * # Set a budget request propertly 
     *
     * - R1 - The service will create a new budget request in pending status with the indicated fields.
     * - R2 - If there is no user with the indicated email, a new user will be created.
     * - R3 - If there is a user with the indicated email will modify the phone and the address by the indicated ones.
	 * - R4 - The title and category are not required to create a new budget request.   
	 * - C1 -  
     * @Route("/api/budget/set")
     */
    public function createBudgetRequest()
    {

        $em = $this->getDoctrine()->getManager();
		
		$budget = new Budget;

		// C1 - If the description, email, phonenum or address is empty the request returns error message
		foreach($this->parameters['budgeting']['required'] as $value){
			if (!empty($_POST[$value])) {
				$budget->$value = $_POST[$value];
			} else {
				$this->exception(400, "The field '$value' is required for create a budget request");
			}
		}

        // C1 - We retrieve the user identifier based on the email to load it into the user_id of the budget
        // R2 - If there is no user with the indicated email, a new user will be created.
        // R3 - If there is a user with the indicated email will modify the phone and the address by the indicated ones.
        $this->setUser($_POST, $budget->user_id);

		// R4 - The title and category are not required to create a new budget request.
		foreach($this->parameters['budgeting']['unrequired'] as $value){
			if (!empty($_POST[$value])) {
				$budget->$value = $_POST[$value];
			}
		}

        // R1 - The service will create a new budget request in pending status with the indicated fields.
        $em->persist($budget);
        $em->flush();

		$this->exception(200, "A new budget was created with 'id' {$budget->id}");
            
	}

    /**
     * # Edit a pending budget request
     *
     * - R1 - If the request is not pending and is attempted to be modified, the error must be notified.
     * - R2 - While the budget request is pending, it should be possible to modify the title, description and category.
     * - C1 - A look on the user and possible changes: inside data or the budget auth
     * @Route("/api/budget/set/{id}")
     */
    public function updateBudgetRequest($id)
    {

        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository(Budget::class)->find($id);
    
        if (!$budget) {
            $this->exception(404, "No budget found for id '$id'");
        }
    
        // R1 - If the request is not pending and is attempted to be modified, the error must be notified.
        if ($budget->status != $this->status[0]) {
            $this->exception(400, "Cannot update a budget request without 'status' as '{$this->status[0]}'");
        }

        // C1 - A look on the user and possible changes: inside data or the budget auth
        $this->setUser($_POST, $budget->user_id);

        // R2 - While the budget request is pending, it should be possible to modify the title, description and category.
		foreach($this->parameters['budgeting']['is_pending'] as $value){
			if (!empty($_POST[$value])) {
				$budget->$value = $_POST[$value];
			}
		}

        $em->flush();

        $this->exception(200, "The budget with id '$id' was updated");

	}
	
	/**
     * # Get a budget by request propertly 
	 *
     * @Route("/api/budget/{id}")
     */
	public function getBudgetRequest($id)
	{
		$em = $this->getDoctrine()->getManager();
		$budget = $em->getRepository(Budget::class)->findOneById($id);
            
		// We retrieve the user that corresponds to the email
		$user = $em->getRepository(User::class)->findOneById($budget->user_id);

		if (!$user) {
			$this->exception(404, "No user found for the user_id '{$budget->user_id}'");
		}

		$budget->email 		= $user->email;
		$budget->phonenum 	= $user->phonenum;
		$budget->address 	= $user->address;		

		return $budget;		 
	}
    
	/**
     * # Populate a pending budget request
     *
     * - R1 - To be able to publish the request of budget it is required that the request is pending and contains title and category.
     * - R2 - The service will verify that the request meets the requirements and, if it complies with them, will modify the published status.
     * - R3 - If the budget does not meet the requirements should be warned of the error.
     *
     * @param Id $id
     * @Route("/api/budget/populate/{id}")
     */
    public function populateBudgetRequest($id)
    {

        $em = $this->getDoctrine()->getManager();
        
        $budget = $em->getRepository(Budget::class)->find($id);

        if (!$budget) {
            $this->exception(404, "No budget found for the 'id' $id");
		}

        if (empty($budget->category) || empty($budget->title)) {

            // R1 - To be able to publish the request of budget it is required that the request is pending and contains title and category.
            $this->exception(404, 'Cannot update a request without category or title');
		
		} else {
		
			// R2 - The service will verify that the request meets the requirements and, if it complies with them, will modify the published status.
			$budget->status = $this->status[2];

			$em->flush();
			
			$this->exception(200, "The budget with the id '{$budget->id}' was populated");
	   
		}

    }

    /**
     * # Discard a budget request
     *
     * - R1 - If the budget request was discarted before, should advise about the error
     * - R2 - This service modifies the status of a pending or published request and places it as discarded.
     *
     * @param Id $id
     * @Route("/api/budget/discard/{id}")
     */
	public function discardBudgetRequest($id)
	{

        $em = $this->getDoctrine()->getManager();
        
        $budget = $em->getRepository(Budget::class)->find($id);

        if (!$budget) {
            $this->exception(404, "No budget found for the 'id' $id");
        }

        if ($budget->status == $this->status[2]) {

            // R1 - If the budget request was discarted before, should advise about the error
            $this->exception(400, "The budget with id => $id already discarted");
        
        } else {
        
            // R2 - This service modifies the status of a pending or published request and places it as discarded.
            $budget->status = $this->status[2];

			$em->flush();
			
			$this->exception(200, "The budget with id '$id' was discarted");

		}

    }
	
    /**
     * # Get the paginated list of the budgeting
     *
     * - R1 - The service will return a paginated listing of budget requests based on the user of the entered email.
	 * - C1 - Paginated with parameters 'all' for show all the pages (0 is the first page)
	 * 
	 * @Route("/api/budget")
	 * @Route("/api/budgeting/list/{page}")
     * @Route("/api/budgeting/list/{email}/{page}")
     */
    public function listBudgeting($email = null, $page = null) 
    {

		if ($page == null) {
			$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
		}

        $em = $this->getDoctrine()->getManager();
        
        if (!empty($email)) {
            
            // We retrieve the user that corresponds to the email
            $user = $em->getRepository(User::class)->findOneByEmail($email);
    
            if (!$user) {
                $this->exception(404, "No user found for the 'email' '$email'");
            }

            $budgeting = $em->getRepository(Budget::class)->findBy(array('user_id' => $user->id));

            // R1 - The service will return a paginated listing of budget requests based on the user of the entered email.
            if (!$budgeting) {
                $this->exception(404, "No budgeting found for id {$user->id}");
			} 
			
        } else {

            $budgeting = $em->getRepository(Budget::class)->findAll();

            // R1 - The service will return a paginated list of budget requests
            if (!$budgeting) {
                $this->exception(404, 'No budgeting found!');
			}

		}

		return $this->paginateResult('budgeting', $budgeting, $page);

	}
	
	/**
	 * # Simple category suggestion for a posted 'description', php 'similar_text' function based
	 * - ROPT - Optional requirement
	 * @Route("/api/category/suggest")
	 */
	public function getCategorySuggest() {

		return $this->categorySuggest($_POST);

	} 


	// Users

    /**
     * The purpose of this function is to return a user ID, in addition to setting their data for changes
     */
    private function setUser($request, &$return)
    {

		$em = $this->getDoctrine()->getManager();
		
		$this->ensureIsValidEmail($request['email']);

        $repository = $this->getDoctrine()->getRepository(User::class);

		$this->ensureIsValidEmail($request['email']);

        $user = $repository->findOneByEmail($request['email']);

        if (!empty($user)) {

            $user->phonenum = $request['phonenum'];
            $user->address = $request['address'];

            $em->persist($user);
            $em->flush();

            $return = $user->id;
        
        } else {
            
            $return = $this->createUser($request);

        }

    }

    /**
     * Create a user that did not exist
     */
    private function createUser($request)
    {

		$this->ensureIsValidEmail($request['email']);

        $em = $this->getDoctrine()->getManager();

        $user = new User();
        
        $user->email = $request['email'];
        $user->phonenum = $request['phonenum'];
        $user->address = $request['address'];
        
        $em->persist($user);
        $em->flush();

        return $user->id;

	}
	

	// Utils

	/**
	 * # Simple category suggestion for a posted 'description', php 'similar_text' function based
	 */
	private function categorySuggest($post) {

		$em = $this->getDoctrine()->getManager();
		
		$training = $em->getRepository(Training::class)->findAll();

		foreach($training as $key => $value) {

			similar_text($value->description, $post['description'], $percent);
			if ($percent > $this->percent_approved) {
				$recount[] = array(
					'category' => $value->category,
					'coincidence' => "$percent%",
				);
			}

		}

		if (empty($recount)) {

			$this->exception(404, "There's not approved or considered good suggestion for your description: '{$_POST['description']}'");
		
		}

		return $recount[0];

	}

	/**
	 * A function to set a paginated result for a list request
	 */
	private function paginateResult($name, $content, $page = null) 
	{

		$total_content = count($content);

		$paged_content = array_chunk($content, $this->page_size);

		$total_pages = count($paged_content);

		if ($page > $total_pages || $page == 0){
			$this->exception(400, "The '$page' page not exist");
		}

		$links = [
			'self' 	=> array( 'href' => "{$this->host}?page=$page"),
			'first'	=> array( 'href' => "{$this->host}?page=1"),
			'last' 	=> array( 'href' => "{$this->host}?page=$total_pages"),
		];

		if ($page > 1) {
			
			$preview_page = $page - 1;
			$links['prev'] = array('href' => "{$this->host}?page=$preview_page");
		
		}

		if ($total_pages > $page) {
			
			$next_page = $page + 1;
			$links['next'] = array('href' => "{$this->host}?page=$next_page");

		} 

		$page_content = $paged_content[$page-1];

		foreach ($page_content as $key => $values) {

			$return_add[$key]['_links']['self']['href'] = "{$this->host}/".$values->{$this->parameters[$name]['primary']};

			// We retrieve the user that corresponds to the user_id from the Budget
			$em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->findOneById($values->user_id);
			
			$values->email = $user->email;
			$values->phonenum = $user->phonenum;
			$values->address = $user->address;

			foreach($this->parameters[$name]['all'] as $param){
				$return_add[$key][$param] = $values->$param;
			}

		}

		$return = array("$name" => $return_add);

		$result = [
			'_links' => $links,
			'count' => $total_pages,
			'total' => $total_content,
			'_embedded' => $return,
		];

		return $result;
				
	}
	 
	/**
	 * Email validation for the users settings
 	 */
    private function ensureIsValidEmail($email)
    {
	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->exception(400, "'$email' is not a valid email address");
		}

		return true;

    }

    /**
     * Parsing exceptions...
     */
	private function exception($exception_num, $message)
	{
		throw new HttpException($exception_num, $message);
	}

}
