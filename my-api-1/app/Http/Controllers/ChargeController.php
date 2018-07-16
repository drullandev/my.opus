<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MyController;

use App\Models\Payment;
use App\Models\Charge;
use App\Libs\ChargeInterface;

class ChargeController extends MyController
{

    private $typePercent = [
        'CC' => 10,
        'DD' => 7,
    ];

    // HELP ON THIS :: BEGIN
    /*
        protected $chargeRepo;

        public function __construct( ChargeInterface $chargeRepo )
        {
            $this->chargeRepo = $chargeRepo;
        }
        */

        public function testInterface()
        {

            echo 'Test consist in multiply the amount with the value on the class';

            echo 
            'The calculation of the amount for direct debit and credit card must be written in different
            classes and both classes must implement an interface that will enforce a method called charge.';

            $amount = 100;
            $finalAmount = null;
            $type = 'CC';

            //Ok, i don't have those params match anywhere ejem... i'm lost on this point with interfaces lol
            if ( $type == 'CC' ) {
                $finalAmount = $this->chargeRepo->charge('CreditCard', $amount ); 
                //I Wait 107 as $finalAmount
            } else if ( $type == 'DD' ) {
                $finalAmount = $this->chargeRepo->charge('DebitDirect', $amount );
                //I Wait 110 as $finalAmount
            }

            return $finalAmount;
        
        }
    
    // HELP ON THIS :: END

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function set( Request $req )
    {
        $this->rules( 'set' );
        $this->params = $req->all();
        if ( $errors = $this->myValidator() ) return $errors;

        $this->params = (object) $req->all();

        $payment = Payment::where( 'id', '=', $this->params->payment_id )->get()[0];

        $amount = 
            $this->params->amount + 
            ( 
                $this->params->amount * 
                ( 
                    $this->typePercent[ $payment->type ] / 100 
                )
            );
        $this->params->amount = number_format( $amount, 2, ".", '' );
        
        $newCharge = Charge::create( (array) $this->params );
        
        if ( $newCharge != null ) $this->params->id = (string) $newCharge->id;
        
        $this->res = ( $newCharge != null ? 
            [ (array) $this->params,       200 ] : 
            [ $this->rules( 'set_error' ), 400 ]
        );
        return $this->myResponse();
    }

    /**
     * Get one or all the Charges from model
     * @param  \Illuminate\Http\Request $id = null
     * @return \Illuminate\Http\Response
     */
    public function get( $id = null )
    {
        if ( $id ) {
            $this->rules('get');
            $this->params['id'] = $id;
            if ( $errors = $this->myValidator() ) return $errors;
        }

        $chargeData = ( $id ? 
            Charge::select( 'id', 'payment_id', 'amount' )->find( $id )->getAttributes() :
            json_decode( Charge::select( 'payment_id', 'amount' )->orderBy( 'payment_id', 'asc' )->get() )//->limit(1000);
        );


        $this->res = ( $chargeData ? 
            [ $chargeData,                                200 ] :
            [ [ 'error'   => $this->rules('get_error') ], 404 ] 
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
            'get' => [
                'id'        => 'string  | required',
            ],
            'set' => [
                'payment_id'=> 'string  | required',
                'amount'    => 'numeric | required | between: 0,999999999.99',
            ],
            'set_error'     => [ 
                'mesage'    => [ 'Error message' ],
            ],
            'get_error'     => [ 
                'default'   => [ 'error'   => [ 'Error message' ] ],
                'notExist'  => [ 'error'   => [ 'Charge doesn\'t exist' ] ]
            ],
        ];
        $this->rules = ( ! empty( $rules[ $function ] ) ? $rules[ $function ] : $rules );
        return $this->rules;
    }

}
