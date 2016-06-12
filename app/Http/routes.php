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
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', ['middleware' => ['guest'], 'uses' => 'RoutingController@login']);
        Route::get('verify/{confirmation_code}', ['middleware' => ['auth'], 'uses' => 'Auth\VerifyController@verify']);
    });
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('forgot', 'Auth\ForgotController@viewForgot');
    Route::post('forgot', 'Auth\ForgotController@postForgot');
    Route::get('reset/{encrypted_email}/{confirmation_code}', 'Auth\ForgotController@viewReset');
    Route::post('reset', 'Auth\ForgotController@postReset');
    Route::get('logout', 'Auth\AuthController@logout');

    /*QBE CHAMS*/
    Route::group([
        'prefix' => 'chams',
        'middleware' => ['auth', 'role:chams_admin|chams_asset_distributor|chams_asset_manager|chams_client|chams_reporter|chams_staff']
    ], function () {
        Route::get('/', ['uses' => 'CHAMS\RoutingController@home']);
        Route::get('users', ['middleware' => ['auth', 'role:chams_admin'], 'uses' => 'CHAMS\RoutingController@users']);
    });

//    Route::group([
//        'prefix' => 'user',
//        'middleware' => ['auth', 'role:kb_admin']
//    ],function(){
//        Route::get('/', ['uses' => 'UserController@users']);
//        Route::get('{user_id}', ['uses' => 'UserController@user']);
//    });

    /*we need to have separated url for ajax and html page calls because chrome cache*/
    Route::resource('admin/user', 'UserController');
    Route::put('admin/user/{user_id}/revive', 'UserController@revive');
});