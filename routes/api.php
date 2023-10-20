<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/customers', 'CustomerController@store');
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/{id_user}', 'CustomerController@detail');
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
