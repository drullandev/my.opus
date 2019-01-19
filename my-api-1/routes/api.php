<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Making obvious this ->
 * The calculation of the amount for direct debit and credit card must be
 * written in different classes and both classes must implement an interface
 * that will enforce a method called charge.
 */
/*interface ChargeInterface {
    public function charge( $amount );
}*/
 
/*
class CreditCard implements ChargeInterface {
    private $percent = 7;
    public function charge( $amount ) {
        return ( $amount / 100 ) * ( 100 + $this->percent );
    }
}

class DebitDirect implements ChargeInterface {
    private $percent = 10;
    public function charge( $amount ) {
        return ( $amount / 100 ) * ( 100 + $this->percent );
    }
}
*/


// Payment
Route::post( 'payment',         'PaymentController@set' );

// Charge
Route::get ( 'charge/{id?}',    'ChargeController@get'  );
Route::post( 'charge',          'ChargeController@set'  );