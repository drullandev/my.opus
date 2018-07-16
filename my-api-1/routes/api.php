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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Payment
Route::post( 'payment',       'PaymentController@set' );

// Charge
Route::get ( 'charge/{id?}',  'ChargeController@get'  );
Route::post( 'charge',        'ChargeController@set'  );

// TEST
Route::get(  'testInterface', 'ChargeController@testInterface' );