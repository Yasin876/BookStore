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


Route::get('/',[
      'uses'=>'FrontEndController@index',
      'as'=>'index'
    ]);

Route::get('/product/{id}',[
    'uses'=>'FrontEndController@singleProduct',
    'as'=>'product.single'
]);

Route::post('/cart/add',[
    'uses'=>'ShoppingCardController@add_to_cart',
    'as'=>'cart.add'
]);

Route::get('/cart' , [
    'uses'=>'ShoppingCardController@cart',
    'as'=>'cart',
]);

Route::get('/cart/delete/{id}','ShoppingCardController@delete_item')->name('cart.delete');

Route::get('cart/decr/{id}/{qty}',[
    'uses'=>'ShoppingCardController@cart_decrement',
    'as'=>'cart.decr'
]);

Route::get('cart/incr/{id}/{qty}',[
    'uses'=>'ShoppingCardController@cart_increment',
    'as'=>'cart.incr'
]);

Route::get('cart/add/rapid/{id}',[
    'uses'=>'ShoppingCardController@rapid_add',
    'as'=>'cart.rapid.add'
]);

// showing checkout page
Route::get('cart/checkout',[
    'uses'=>'CheckOutController@index',
    'as'=>'cart.checkout'
]);
// recieve cart payment 
Route::post('cart/checkout/',[
    'uses'=>'CheckOutController@pay',
    'as'=>'cart.stripe'
]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/products','ProductsController');

