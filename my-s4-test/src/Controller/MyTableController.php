<?php

namespace App\Controller;

use App\Entity\MyTable;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyTableController extends Controller
{

    public function index()
    {
        echo 'Hello!';
        //$repository = $this->getDoctrine()->getRepository(MyTable::class)->findAll();
    }

}
