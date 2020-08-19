<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'driver'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'DriverController@index']);
    Route::post('/', ['as' => 'show', 'uses' => 'DriverController@show']);
});

Route::group(['prefix' => 'report'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'ReportController@index']);
    Route::post('/', ['as' => 'filter', 'uses' => 'ReportController@filter']);
});

Route::group(['prefix' => 'address'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'AddressController@index']);
    Route::post('/', ['as' => 'format', 'uses' => 'AddressController@format']);
});
