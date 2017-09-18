<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Unirest;

class DefaultController extends Controller
{

    public function indexAction()
    {

         $response = Unirest\Request::get('/api/budget/list', $headers);

        // Display the result
        dump($response->body);

    }

}
