
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

//Products
Route::get('products', 'ProductController@index');
Route::get('products/{id}', 'ProductController@show');
Route::post('products', 'ProductController@create');
Route::put('products/{id}', 'ProductController@update');
Route::delete('products/{id}', 'ProductController@destroy');

//Category
Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@show');
Route::post('categories', 'CategoryController@create');
Route::put('categories/{id}', 'CategoryController@update');
Route::delete('categories/{id}', 'CategoryController@destroy');

//Transaksi
Route::get('transactions', 'TransactionController@index');
Route::get('transactions/{id}', 'TransactionController@show');
Route::post('transactions', 'TransactionController@create');
Route::put('transactions/{id}', 'TransactionController@update');
Route::delete('transactions/{id}', 'TransactionController@destroy');

//Checkout
Route::post('checkout', 'CheckoutController@checkout');

