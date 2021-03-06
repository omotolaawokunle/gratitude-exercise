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

Route::group(['prefix'=>'products'], function(){
    Route::get('/', 'ProductController@index');
    Route::get('/{product}', 'ProductController@show');
    Route::post('/create', 'ProductController@store');
    Route::post('/edit/{product}', 'ProductController@update');
    Route::get('/delete/{product}', 'ProductController@destroy');
});
