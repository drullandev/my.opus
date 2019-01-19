<?php

namespace App\Http\Controllers;

use App;

class DebitDirect implements ChargeInterface {

    private $percent = 10;

    public function charge( $amount ) {

        return ( $amount / 100 ) * ( 100 + $this->percent );
        
    }

}
