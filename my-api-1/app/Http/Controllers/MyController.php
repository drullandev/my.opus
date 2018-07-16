<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class MyController extends Controller
{

    /**
     * A simpe validation funnel for entire app
     * @param $this->rules  // The validation rules from the objects
     * @param $this->res    // Response  
     */
    public function myValidator()
    {
        $val = Validator::make( $this->params, $this->rules );
        if ( $val->fails() ) {
            $this->res = [ [ 'message' => $val->errors() ],  400 ];
            return $this->myResponse();
        } 
    }

    public function myResponse()
    {
        if ( count( $this->res ) != 2 )
            return response()->json( [ 'error' => [ 'I haven\' enough data to response...' ] ], 404 );
        
        $res = response()->json( (array) $this->res[0], $this->res[1] );
        return $res;
    }
    
}
