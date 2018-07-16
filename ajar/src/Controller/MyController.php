<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyController extends Controller
{

    public function echo($echo)
    {
        echo $echo."\n";
    }

}
