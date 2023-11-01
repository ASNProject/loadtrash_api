<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/customers', 'CustomerController@store');
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/{id_user}', 'CustomerController@detail');
Route::delete('/customers/{id_user}', 'CustomerController@destroy');

Route::post('/credits', 'CreditController@store');
Route::get('/credits', 'CreditController@index');
Route::get('/credits/{id_user}', 'CreditController@detail');

Route::post('/debits', 'DebitController@store');
Route::get('/debits', 'DebitController@index');
Route::get('/debits/{id_user}', 'DebitController@detail');

Route::post('/loads', 'LoadController@store');
Route::get('/loads', 'LoadController@index');
Route::get('/loads/{code}', 'LoadController@detail');

Route::post('/customers', 'CustomerController@store');
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/{id_user}', 'CustomerController@detail');

Route::post('/statuses', 'StatusController@store');
Route::get('/statuses', 'StatusController@index');
Route::get('/statuses/{id_status}', 'StatusController@detail');

Route::post('/type-wastes', 'TypeWasteController@store');
Route::get('/type-wastes', 'TypeWasteController@index');
Route::get('/type-wastes/{id_type}', 'TypeWasteController@detail');
Route::delete('/type-wastes/{id_type}', 'TypeWasteController@destroy');


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
