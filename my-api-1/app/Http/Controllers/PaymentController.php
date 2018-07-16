<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MyController;

use App\Models\Payment;

class PaymentController extends MyController
{ 

    /*public function testValid( Request $req ) {
        $this->params = $req->all();
        $this->rules('set');
        if ( $errors = $this->myValidator() ) return $errors;
    }*/

    /**
     * Set a Payment Object
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function set( Request $req )
    {
        $this->params = array_map( 'strtoupper', $req->all() );
        $this->rules('set') ;
        if ( $errors  = $this->myValidator() ) return $errors;

        $payment    = new Payment();
        $newPayment = $payment::create( $this->params );
        if( $newPayment ) $newPayment->id = (string) $newPayment->id;

        $this->res = ( $newPayment ? 
            [ $newPayment->getAttributes(), 200 ] :
            [ $this->rules('set_error'),    404 ]
        );
        return $this->myResponse();
    }

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
    private function rules( $function = null )
    {
        $rules = [
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
        $this->rules = ( ! empty( $rules[ $function ] ) ? $rules[ $function ] : $rules );
        return $this->rules;
    }

}
