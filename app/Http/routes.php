<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'RoutingController@home');
    Route::get('login', 'RoutingController@login');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::group(['prefix' => 'register'], function(){
        Route::get('/', 'RoutingController@registerSuccess');
        Route::get('verify/{confirmation_code}', 'Auth\AuthController@verify');
    });
});