<?php

namespace App\Http\Controllers;

use App;

use Validator;
use Illuminate\Http\Request;

class MyController extends Controller
{

    /**
     * How the payment type matchs Interface Class
     */
    private $paymentType = [
        'CC' => 'CreditCard',
        'DD' => 'DebitDirect',
    ];

    /**
     * My Charge interface
     */
    public function myChargeAmount( $type, $amount )
    {
        App::bind( 'ChargeInterface', $this->paymentType[ $type ] );
        $chargeInterface = App::make( 'ChargeInterface' );  
        return number_format( $chargeInterface->charge( $amount ), 2, ".", '' );
    }

    /**
     * A simpe validation funnel for entire app
     * @param $params // The params 
     * @param $rules  // The validation rules from the objects
     */
    public function myValidator( $params, $rules )
    {
        $validation = Validator::make( $params, $rules );
        if ( $validation->fails() ) return $this->myResponse( [ [ 'message' => $validation->errors() ],  400 ] );
    }

    /**
     * A simpe response funnel for entire app
     * @param $response    // Response  
     */
    public function myResponse( $result )
    {
        if ( count( $result ) != 2 )
            return response()->json( [ 'error' => [ 'I haven\' enough data to response...' ] ], 404 );
        
        $return = response()->json( (array) $result[0], $result[1] );
        return $return;
    }
    
}
