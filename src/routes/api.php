<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function() {
    Route::group(['namespace' => 'Auth'], function(){
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')
        ->middleware('auth:sanctum');
        
    });

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::apiResource('events', 'EventController');
        Route::group(['prefix' => 'me'], function(){
            Route::get('/', 'UserController');
            Route::apiResource('events', 'UserEventController');
        });
        Route::apiResource('events.tickets', 'TicketController');
        Route::apiResource('payment-accounts', 'PaymentAccountController');
        Route::post('tickets/{ticket}/purchase', 'PaymentController@buy');
    });
});