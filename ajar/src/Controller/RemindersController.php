<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Invoice;

use Doctrine\DBAL\Driver\Connection;

class RemindersController extends MyController
{

    public function dispatch(){
        
        $sql = 'SELECT * FROM invoice';
        //$invoices = $connection->fetchAll($sql);
        //$invoice = EntityManager::find('App\Entity\Invoice', 1 );
        //$invoice = $this->em->getDoctrine()->getRepository(Invoice::class)->find(1);
        //var_export($invoice);
        //$entityManager = $this->getDoctrine()->getManager(); 

        $em = self::getKernel()->getContainer()->get('doctrine.orm.entity_manager');
        /*
        $this->reviewLeases();
        $this->setReminders();
        $this->sendReminders();
        */

    }

    /**
     * This function 
     */
    private function reviewLeases()
    {
        $this->echo(__FUNCTION__);
    }

    /**
     * This function 
     */
    private function setReminders()
    {
        $this->echo(__FUNCTION__);
    }

    /**
     * This function 
     */
    private function sendReminders()
    {
        $this->echo(__FUNCTION__);
    }

}
