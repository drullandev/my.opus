<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MyController;

use App\Models\Payment;
use App\Models\Charge;

class ChargeController extends MyController
{

    /**
     * Charge Endpoints rules
     * Charge Object ::
     * {
     *     "id":        "string",
     *     "payment_id: "string",
     *     "amount":    "float",
     * }
     */
    public $rules = [
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
    
    /**
     * How the payment type matchs Interface Class
     */
    private $typeInterface = [
        'CC' => 'CreditCard',
        'DD' => 'DebitDirect',
    ];

    /**
     * Get one or all the Charges from model
     * @param  \Illuminate\Http\Request $id = null
     * @return \Illuminate\Http\Response
     */
    public function get( $id = null )
    {
        if ( $id && $errors = $this->myValidator( [ 'id' => $id ], $this->rules['get'] ) ) return $errors;
        
        $chargeObj = new Charge;
        if ( $id ) {
            $chargeData = $chargeObj::find( $id )->getAttributes();
            $chargeData = array_map( 'strtoupper', $chargeData );
            $chargeData['amount'] = (float) $chargeData['amount'];
        } else {
            $chargeData = json_decode( $chargeObj::select( 'payment_id', 'amount' )->orderBy( 'payment_id', 'asc' )->get() );
        }
        
        return $this->myResponse( $chargeData ? 
            [ $chargeData,                                200 ] :
            [ [ 'error'   => $this->rules['get_error'] ], 404 ] 
        );
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function set( Request $req )
    {
        if ( $errors = $this->myValidator( $req->all(), $this->rules['set'] ) ) return $errors;

        $params = (object) $req->all();

        $payment = Payment::find( $params->payment_id );

        $params->amount = $this->myChargeAmount( $payment->type, $params->amount );

        $newCharge = Charge::create( (array) $params );
        
        if ( $newCharge ) {
            $theCharge = Charge::find( $newCharge->id )->getAttributes();//ordered again!!
            $theCharge = array_map( 'strtoupper', $theCharge );
            $theCharge['amount'] = (float) $theCharge['amount'];
        }

        return $this->myResponse( $newCharge != null ? 
            [ $theCharge,                   200 ] : 
            [ $this->rules['set_error'],    400 ]
        );
    }

}
