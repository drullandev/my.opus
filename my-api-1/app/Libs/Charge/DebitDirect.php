<?php

namespace App\Libs\Charge;

use App\Libs;

class DebitDirect implements ChargeInterface {

    public function __construct( Request $amount ) {
        return $this->charge( $amount );
    }

    public function charge( $amount ) {
       return ( $amount / 100 ) * 110;
    }

}
