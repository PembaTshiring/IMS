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
    return redirect()->action('HomeController@index');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('brands', 'BrandController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
    Route::resource('customers', 'CustomerController');
    Route::post('brand-update','BrandController@brandUpdate')->name('brand.update');
    Route::post('category-update','CategoryController@categoryUpdate')->name('category.update');
    Route::post('product-update','ProductController@productUpdate')->name('product.update');
    Route::post('payment-update','OrderController@paymentUpdate')->name('payment.update');
    Route::post('fetch-product-data','OrderController@fetchProductData')->name('fetchProductData');
    Route::post('fetch-selected-product-data','OrderController@fetchSelectedProductData')->name('fetchSelectedProductData');
    Route::get('reports','OrderController@report')->name('reports');
    Route::post('get-order-report','OrderController@getOrderReport')->name('getOrderReport');
    Route::post('print-order','OrderController@printOrder')->name('printOrder');
    Route::get('order-delete/{id}','OrderController@orderDelete')->name('orderDelete');
    Route::get('autocomplete','OrderController@autocomplete')->name('autocomplete');

    Route::get('brand-delete/{id}','BrandController@destroy')->name('brandDelete');
    Route::get('category-delete/{id}','CategoryController@destroy')->name('categoryDelete');
    Route::get('product-delete/{id}','ProductController@destroy')->name('productDelete');
    Route::post('orders/{id}', 'OrderController@update');
    Route::get('profile','HomeController@editProfile')->name('profile');
    Route::post('updateProfile','HomeController@updateProfile')->name('updateProfile');
    Route::get('customer-delete/{id}','CustomerController@destroy')->name('customerDelete');
    Route::post('customer-update','CustomerController@customerUpdate')->name('customer.update');
});