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
<<<<<<< HEAD
Route::get('/admin/upload', 'DetilKontrakController@index')->name('upload');
Route::get('/admin/pelanggan', 'PelangganController@index')->name('pelanggan');
Route::get('/admin/pelanggan/create', 'PelangganController@create')->name('addplg');
Route::get('/admin/perusahaan', 'AnakPerusahaanController@index')->name('perusahaan');
Route::get('/admin/perusahaan/create', 'AnakPerusahaanController@create')->name('addprshn');
Route::get('/admin/layanan', 'LayananController@index')->name('layanan');
Route::get('/admin/layanan/create', 'LayananController@create')->name('addlyn');
Route::get('/admin/accmgr', 'AccountManagerController@index')->name('accmgr');
Route::get('/admin/accmgr/create', 'AccountManagerController@create')->name('addaccmgr');
=======
Route::get('/upload', 'DetilKontrakController@index')->name('upload');


Route::get('acc-mgr', 'AccountManagerController@index');
Route::get('acc-mgr/create', 'AccountManagerController@create');
Route::post('acc-mgr/store', 'AccountManagerController@store');
Route::get('acc-mgr/edit/{id}', 'AccountManagerController@edit');
Route::post('acc-mgr/update', 'AccountManagerController@update');
Route::get('acc-mgr/delete/{id}', 'AccountManagerController@delete');

Route::post('tambahpelanggan','PelangganController@store');
Route::post('editpelanggan','PelangganController@save');
Route::get('pelanggan/create','PelangganController@create');
Route::get('pelanggan/edit/{nipnas}','PelangganController@edit');
Route::get('pelanggan/delete/{nipnas}','PelangganController@delete');
Route::get('pelanggan','PelangganController@index');

Route::post('tambahlayanan','LayananController@store');
Route::post('editlayanan','LayananController@save');
Route::get('layanan/create','LayananController@create');
Route::get('layanan/edit/{id}','LayananController@edit');
Route::get('layanan/delete/{id}','LayananController@delete');
Route::get('layanan','LayananController@index');

Route::post('tambahperusahaan','AnakPerusahaanController@store');
Route::post('editperusahaan','AnakPerusahaanController@save');
Route::get('anak_perusahaans/create','AnakPerusahaanController@create');
Route::get('anak_perusahaans/edit/{id_perusahaan}','AnakPerusahaanController@edit');
Route::get('anak_perusahaans/delete/{id_perusahaan}','AnakPerusahaanController@delete');
Route::get('anak_perusahaans','AnakPerusahaanController@index');
>>>>>>> d12e427d68594c67f92910c0271fc1524aafe117
