<?php

use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\UserEventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function(){
    Route::group(['namespace' => 'Auth'], function(){
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')->middleware('auth:sanctum');
    });

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::apiResource('events', 'EventController');
        Route::group(['prefix' => 'me'], function(){
            Route::get('/', 'UserController');
            Route::apiResource('events', 'UserEventController');
        });
        Route::apiResource('events.tickets', 'TicketController');
    });
});