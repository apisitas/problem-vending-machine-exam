<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('/')->name('')->group(function () {
    Route::get('/refund', 'AppController@coin_refund')->name('coin.refund');

    Route::get('/', 'AppController@product_index')->name('product.index');
    Route::get('/{id}', 'AppController@product_process')->name('product.process');
    Route::get('/process/{coin}', 'AppController@coin_process')->name('coin.process');
});

// Route::group(['prefix' => '/coin'], function () {
//     Route::get('/', 'AdminController@admin')->name('admin');
// });