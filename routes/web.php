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

//Route::get('/', function () {
//   return view('welcome');
//});
Route::get('/','HomeController@index');   //yukarıdakiyle aynı


Route::get('test/{name}','TestController@test_name');

Route::get('/test', 'TestController@get_test') ;

Route::get('/form','TestController@get_form');

Route::post('/form','TestController@post_form');

Route::get('/customers', 'TestController@get_customers');

Route::get('/myProfile/{forum}/{php}/{laravel}', 'TestController@get_categories');

Route::get('/user','UserController@get_user');

Route::post('/user','UserController@post_user');

Route::get('/product','productController@index');

Route::get('/customer','customerController@index');

Route::get('/product_order','orderController@product_buy');

Route::get('/customer_orders','customerController@customer_order');

Route::get('/order','orderController@index');
Route::post('/order/detail','orderController@detail');
Route::post('/order/buy','orderController@buy');
Route::post('/product_order/calculate','orderController@calculate');
Route::post('/customer_orders/calculate','customerController@calculate');

Route::post('/customer/add' ,  'customerController@add');
Route::post('/customer/delete','customerController@delete');
Route::post('/customer/detail','customerController@detail');
Route::post('/customer/fetch_data','customerController@fetchData');
Route::post('/customer/update','customerController@update');

Route::post('/product/add'  , 'productController@add');
Route::post('/product/delete','productController@delete');
Route::post('/product/detail','productController@detail');
Route::post('/product/fetch_data','productController@fetchData');
Route::post('/product/update','productController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/fetch', 'HomeController@fetch_data')->name('home');
Route::post('/home/fetch_product', 'HomeController@fetch_product_rate')->name('home');


