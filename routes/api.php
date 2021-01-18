<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




//api routes
Route::get('company', 'Api\CompanyController@getAllCompany');
Route::get('company/{id}', 'Api\CompanyController@getCompany');
Route::post('company', 'Api\CompanyController@createCompany');
Route::put('company/{id}', 'Api\CompanyController@updateCompany');
Route::delete('company/{id}','Api\CompanyController@deleteCompany');
