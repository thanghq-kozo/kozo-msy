<?php

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

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::post('/', 'OrderController@create')->name('create');
});
Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
    Route::get('/', 'ContractController@index')->name('index');
    Route::post('/', 'ContractController@create')->name('create');
    Route::put('/', 'ContractController@updateStatus')->name('updateStatus');
    Route::get('/remind', 'ContractController@getOrdersRemind')->name('getOrdersRemind');
    Route::get('/update_count', 'ContractController@updateCount')->name('updateCount');
    Route::get('/{id}', 'ContractController@getContractByIdOrder')->name('getContractByIdOrder');
});
