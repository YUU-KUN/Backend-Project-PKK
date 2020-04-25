<?php

use Illuminate\Http\Request;

Route::post('register', 'UserController@register'); //register user (pembeli dan penjual)
Route::post('login', 'UserController@login'); //login user (pembeli dan penjual)

Route::middleware(['jwt.verify'])->group(function(){

	// logout
		Route::post('logout', "UserController@logout"); //logout user (pembeli dan penjual)

	//cek login
		Route::get('user/check' , "UserController@getAuthenticatedUser");

	//produk crud (login dulu dengan penjual)
	Route::get('/upload', 'UploadController@index'); //tampil semua produk yang dibuat
    Route::get('/upload/{limit}/{offset}', 'UploadController@getAll'); //tampil semua produk yang dibuat
    Route::post('/upload/{id}', 'UploadController@update'); //edit produk yang dibuat
    Route::post('/upload', 'UploadController@store'); //tambah produk yang dibuat
	Route::delete('/upload/{id}', 'UploadController@destroy'); //hapus produk yang dibuat
		
		// Tambah ke Cart
	Route::post('/cart', 'CartController@store'); //tambah cart
	Route::get('/cart', 'CartController@index'); //tampil semua produk cart
    Route::get('/cart/{limit}/{offset}', 'CartController@getAll'); //tampil semua produk cart
    Route::post('/cart/{id}', 'CartController@update'); //edit produk cart
	Route::delete('/cart/{id}', 'CartController@destroy'); //hapus produk cart

    //transaksi (login dulu dengan pembeli)
    Route::get('/pesan', 'TransaksiController@index'); //tampil semua produk yang dibeli
    Route::get('/pesan/{id}', 'TransaksiController@show'); //tampil beberapa produk yang dibeli
    Route::post('pesan/{id}', 'TransaksiController@pesan'); //pesan produk yang dibeli
    Route::put('/pesan/{id}', 'TransaksiController@update'); //edit produk yang dibeli
    Route::delete('/pesan/{id}', 'TransaksiController@destroy'); //hapus produk yang dibeli
    Route::get('/pesan/user/{id}', 'TransaksiController@detail'); //menampilkan gabungan user dan produk

    //penjual crud
  	Route::get('penjual', "PenjualController@index"); //read data
		Route::get('penjual/{limit}/{offset}', "PenjualController@getAll"); //read data
		Route::post('penjual', 'PenjualController@store'); //create data
		Route::put('penjual/{id}', "PenjualController@update"); //update data
		Route::delete('penjual/{id}', "PenjualController@delete"); //delete data


	// ORI
	Route::get('/book', 'BookController@index');
	Route::get('/book/{id}', 'BookController@show');
	Route::post('/book', 'BookController@store');
	Route::put('/book/{id}', 'BookController@update');
	Route::delete('/book/{id}', 'BookController@destroy');

	//user
	Route::get('user/{limit}/{offset}', "UserController@getAll");
	Route::post('user/{limit}/{offset}', "UserController@find");
	Route::delete('user/delete/{id}', "UserController@delete");
	Route::post('user/ubah', "UserController@ubah");
	

});
