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
//Route::group(['middlewareGroups' => ['web']], function () {

/**
 * @start KB Authentication Routes
 */
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
/**
 * @end KB Authentication Routes
 */


/**
 * @start Access media stored in KB DB
 */
Route::group(['prefix' => 'media'], function () {
    Route::get('profile/{name}/{id}', 'MediaController@profile');
});
/**
 * @end Access media stored in KB DB
 */


/**
 * @start User Routes
 */
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', ['uses' => 'User\ProfileController@index']);
        Route::get('edit', ['uses' => 'User\ProfileController@edit']);
        Route::get('{id}', ['uses' => 'User\ProfileController@show']);
        Route::put('/', ['uses' => 'User\ProfileController@update']);
    });
});
/**
 * @end User Routes
 */

/**
 * @start CHAMS Routes
 */
/*QBE CHAMS*/
Route::group([
    'prefix' => 'chams',
    'middleware' => ['auth', 'role:chams_admin|chams_asset_distributor|chams_asset_manager|chams_client|chams_reporter|chams_staff']
], function () {
    Route::get('/', ['uses' => 'CHAMS\RoutingController@home']);
    Route::get('users', ['middleware' => ['auth', 'role:chams_admin'], 'uses' => 'CHAMS\RoutingController@users']);
});
/**
 * @end CHAMS Routes
 */

/**
 * @start Admin Routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('user', 'UserController');
    Route::put('user/{user_id}/revive', 'UserController@revive');
});
/**
 * @end Admin Routes
 */
//});