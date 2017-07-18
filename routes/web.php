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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('tambahpelanggan','PelangganController@store');
Route::post('editpelanggan','PelangganController@save');
Route::get('pelanggan/create','PelangganController@create');
Route::get('pelanggan/edit/{nipnas}','PelangganController@edit');
Route::get('pelanggan/delete/{nipnas}','PelangganController@delete');
Route::get('pelanggan','PelangganController@index');