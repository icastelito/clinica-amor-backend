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

Route::post('login', 'Auth\ApiAuthController@login');
Route::post('register', 'Auth\ApiAuthController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'Auth\ApiAuthController@details');

    Route::get('clinicas', 'Api\ClinicaController@index');
    Route::get('clinicas/{id}', 'Api\ClinicaController@show');
    Route::post('clinicas', 'Api\ClinicaController@store');
    Route::put('clinicas/{id}', 'Api\ClinicaController@update');

    Route::get('regionais', 'Api\RegionalController@index');
    Route::post('regionais', 'Api\RegionalController@store');
});
