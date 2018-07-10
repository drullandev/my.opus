<?php

namespace App\Controller;

use App\Entity\MyTable;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyTableController extends Controller
{
    /**
     * @Route("/my/table", name="my_table")
     */
    public function index()
    {

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $myTable = new MyTable();
        $myTable->setName('Keyboard');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($myTable);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$myTable->getId());
        /*return $this->render('my_table/index.html.twig', [
            'controller_name' => 'MyTableController',
        ]);*/
    }
}
