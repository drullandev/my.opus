<?php

namespace App\Libs;

class CreditCard implements ChargeInterface {

    public function __construct( Request $amount ) {
        return $this->charge( $amount );
    }

    public function charge( $amount ) {
       return ( $amount / 100 ) * 107;
    }

}
