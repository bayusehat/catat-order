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
//Dashboard Route
Route::get('/','AdminController@index');
//Produk Route
Route::get('/produk','ProductController@index');
Route::get('/tambahproduk','ProductController@create');
Route::get('/search_kategori','ProductController@searchKategoriProduk');
Route::post('/addProduk','ProductController@store');
Route::any('/editProduk/{id}', 'ProductController@show');
Route::any('/deleteProduk/{id}','ProductController@destroy');
Route::any('/updateProduk/{id}','ProductController@update');
//Kategori Produk Route
Route::get('/kategori','KategoriController@index');
Route::post('/addKategori','KategoriController@store');
Route::any('/editKategori/{id}','KategoriController@show');
Route::post('/updateKategori', 'KategoriController@update');
Route::any('/deleteKategoriProduk/{id}', 'KategoriController@destroy');
//Pesan Route
Route::get('/pesan','PesanController@index');
Route::get('/getCity','PesanController@getCity');
