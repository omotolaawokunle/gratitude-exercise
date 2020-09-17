<?php

use App\Product;
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

Route::group(['prefix' => 'products'], function () {
    Route::name('products.')->group(function(){
        Route::get('/', function(){
            return view('products.index');
        })->name('index');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
        Route::get('/{product}', function(){
            return view('products.show');
        })->name('show');
    });
});

