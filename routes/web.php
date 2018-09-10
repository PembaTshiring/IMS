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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/brands',['as'=>'brands', 'uses'=>'BrandController@index']);
Route::get('/categories',['as'=>'categories', 'uses'=>'CategoryController@index']);
Route::get('/products',['as'=>'products', 'uses'=>'ProductController@index']);
Route::get('/orders',['as'=>'orders', 'uses'=>'OrderController@index']);
Route::get('/addorders',['as'=>'addorders', 'uses'=>'OrderController@addorder']);