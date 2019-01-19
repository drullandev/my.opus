<?php

namespace App\Http\Controllers;

use App;

class CreditCard implements ChargeInterface {

    private $percent = 7;
    
    public function charge( $amount ) {

        return ( $amount / 100 ) * ( 100 + $this->percent );

    }

}
