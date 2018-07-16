<?php

use Illuminate\Http\Request;

interface ChargeInterface {
    public function charge( $amount );
}
 
class CreditCard implements ChargeInterface {
    public function charge( $amount ) {
        echo number_format( ( $amount / 100 ) * 107, 2 );
    }
}

class DebitDirect implements ChargeInterface {
    public function charge( $amount ) {
        echo number_format( ( $amount / 100 ) * 110, 2 );
    }
}

Route::get('/', function(){

    App::bind('ChargeInterface', 'DebitDirect');
    $car = App::make('ChargeInterface');  
    echo $car->charge( 100 );

    echo '<br>';

    App::bind('ChargeInterface', 'CreditCard');

    $car = App::make('ChargeInterface');  
    echo $car->charge( 100 );
    
});
