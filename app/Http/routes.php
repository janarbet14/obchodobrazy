<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'Front@index');
Route::get('/products', 'Front@products');
Route::get('/products/details/{id}', 'Front@product_details');
Route::get('/products/categories/{id}', 'Front@product_categories');
Route::get('/products/brands/{name}/{category?}', 'Front@product_brands');
Route::get('/blog', 'Front@blog');
Route::get('/blog/post/{id}', 'Front@blog_post');
Route::get('/contact-us', 'Front@contact_us');
Route::get('/login', 'Front@login');
Route::get('/logout', 'Front@logout');
//Route::get('/cart', 'Front@cart');
Route::post('/cart', 'Front@cart_parse');
Route::get('/checkout', 'Front@checkout');

Route::post('/checkout', 'Front@checkout');
Route::get('/search/{query}', 'Front@search');


Route::get('/cart', 'Front@cart_all');

Route::post('/cart_process','Front@cart_add');

Route::get('cart_process/cart_clear', 'Front@cart_clear' );
Route::delete('cart_process/cart_clear', [
    'as' => 'cart_clear',
    'uses' => 'Front@cart_clear'
]);

Route::get('cart_process/remove/{rowId?}', 'Front@cart_remove' );
Route::delete('cart_process/remove/{rowId?}', [
    'as' => 'cart_remove',
    'uses' => 'Front@cart_remove'
]);

Route::post('/control', [
    'as' => 'control',
    'uses' => 'Front@control'
]);
Route::post('/send', 'OrderDataController@sendEmail');
//Route::get('/order','Front@order');
//Route::post('/order','Front@order');







