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
Route::get('/login','LoginController@index');
Route::post('/doLogin','Logincontroller@doLogin');
Route::any('/logout','AdminController@logout');
//Dashboard Route
Route::get('/','AdminController@index');
Route::get('/testPdf','AdminController@test_pdf');
Route::get('/kategoriSample','AdminController@kategoriSample');
//Produk Route
Route::get('/produk','ProductController@index');
Route::get('/tambahproduk','ProductController@create');
Route::get('/search_kategori','ProductController@searchKategoriProduk');
Route::post('/addProduk','ProductController@store');
Route::any('/editProduk/{id}', 'ProductController@show');
Route::any('/deleteProduk/{id}','ProductController@destroy');
Route::any('/updateProduk/{id}','ProductController@update');
Route::any('/tambahImgProduk/{id}', 'ProductController@tambahImgProduk');
Route::any('/addImgProduk', 'ProductController@addImgProduk');
//Kategori Produk Route
Route::get('/kategori','KategoriController@index');
Route::post('/addKategori','KategoriController@store');
Route::any('/editKategori/{id}','KategoriController@show');
Route::post('/updateKategori', 'KategoriController@update');
Route::any('/deleteKategoriProduk/{id}', 'KategoriController@destroy');
//Pesan Route
Route::get('/pesan','PesanController@index');
Route::get('/getCity','PesanController@getCity');
Route::get('/tambahPesan','PesanController@create');
Route::any('/searchProduk', 'PesanController@searchProduk');
Route::post('/addPesan','PesanController@store');
Route::any('/editPesanan/{id}', 'PesanController@show');
Route::any('/deleteOrderDetail/{id}', 'PesanController@deleteOrderDetail');
Route::any('/deletePesanan/{id}', 'PesanController@destroy');
Route::any('/cetakNota/{id}', 'PesanController@cetakNota');
Route::any('/updatePesanan/{id}', 'PesanController@update');
Route::any('/changeStatus/{id}', 'PesanController@changeStatus');
//Show Image fron Storage
Route::get('/storage/{filename}', function ($filename) {
    $path = 'uploads/'.$filename;
    $content = Storage::disk('local')->put('filename',$filename);
    return $content;
});
//Pengeluaran Route
Route::get('/pengeluaran','PengeluaranController@index');
Route::get('/addPengeluaran','PengeluaranController@create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//AjaxData
Route::get('/dataProdukAjax','ProductController@ajaxData');
