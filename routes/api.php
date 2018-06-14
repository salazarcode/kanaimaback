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

Route::group(['middleware' => 'auth:api'], function () {

    // ESTADOS KYC
    Route::post('kycestados', 'KycestadosController@create');
    Route::get('kycestados/{id?}', 'KycestadosController@retrieve');
    Route::post('kycestados/{id}', 'KycestadosController@update');
    Route::get('kycestados/drop/{id}', 'KycestadosController@delete');

    Route::post('logout','UserController@logoutApi');
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('user/verify/{verification_code}', 'Api\AuthController@verifyUser');

//recibe el email para enviarle al usuario un link de recuperación
//Route::post('recover', 'Api\AuthController@recover');