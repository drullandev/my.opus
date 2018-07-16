<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MyController;
use App\Models\Payment;

class PaymentController extends MyController
{ 

    /**
     * Payment Endpoints rules
     * Payment Object ::
     * {
     *     "id":    "string",
     *     "name:   "string",
     *     "type":  "string", // cc or dd
     *     "iban":  "string", // only for dd
     *     "expiry: "date",   // only for cc
     *     "cc":    "string", // only for cc
     *     "ccv":   "string"  // only for cc
     * }
     */
    public $rules = [
        'set' => [
            'name'    => 'string | required | regex :/^[A-Z ]+$/| max : 22 | bail',
            'type'    => 'string | required | alpha | in :CC,DD| min : 2  | max : 20 | bail',
            'iban'    => 'string | required_if :type,==,DD| min : 15 | max : 32 | bail',
            'expiry'  => 'date   | required_if :type,==,CC| nullable | after :today | bail',
            'cc'      => 'string | required_if :type,==,CC| min : 3 | max : 4',
            'ccv'     => 'string | required_if :type,==,CC| min : 3 | max : 4',
        ],
        'set_error'   => [
            'error'   => 'You can\'t create this payment',
        ],
    ];

    /**
     * Set a Payment Object
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function set( Request $req )
    {
        $params = array_map( 'strtoupper', $req->all() );
        if ( $errors = $this->myValidator( $params, $this->rules['set'] ) ) return $errors;

        $paymentModel = new Payment();
        $newPayment = $paymentModel::create( $params );

        if ( $newPayment ) {
            $thePayment = $paymentModel::find( $newPayment->id )->getAttributes(); // ordered again!!
            $thePayment = array_map( 'strtoupper', $thePayment ); // set all string 
        } 

        return $this->myResponse( $newPayment ? 
            [ $thePayment,                200 ] :
            [ $this->rules['set_error'],  404 ]
        );
    }

}
