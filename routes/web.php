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
Route::get('/admin', 'AdminControllers@index')->name('admin');
Route::get('/admin/upload', 'DetilKontrakController@index')->name('upload');
Route::get('/admin/pelanggan', 'PelangganController@index')->name('pelanggan');
Route::get('/admin/pelanggan/create', 'PelangganController@create')->name('addplg');
Route::get('/admin/perusahaan', 'AnakPerusahaanController@index')->name('perusahaan');
Route::get('/admin/perusahaan/create', 'AnakPerusahaanController@create')->name('addprshn');
Route::get('/admin/layanan', 'LayananController@index')->name('layanan');
Route::get('/admin/layanan/create', 'LayananController@create')->name('addlyn');
Route::get('/admin/accmgr', 'AccountManagerController@index')->name('accmgr');
Route::get('/admin/accmgr/create', 'AccountManagerController@create')->name('addaccmgr');