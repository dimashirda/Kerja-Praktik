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

Route::get('/upload', 'DetilKontrakController@index')->name('upload');


//Route::get('acc-mgr', 'AccountManagerController@index');
Route::get('acc-mgr/create', 'AccountManagerController@create');
Route::post('admin/accmgr/store', 'AccountManagerController@store');
//Route::get('admin/accmgr/edit/{id}', 'AccountManagerController@edit');
Route::post('admin/accmgr/edit/{id}', 'AccountManagerController@update');
Route::get('acc-mgr/delete/{id}', 'AccountManagerController@delete');

Route::post('admin/pelanggan/store','PelangganController@store');
Route::post('admin/pelanggan/edit/{nipnas}','PelangganController@save');
Route::get('pelanggan/create','PelangganController@create');
//Route::get('admin/pelanggan/edit}','PelangganController@edit');
Route::get('admin/pelanggan/delete','PelangganController@delete');
//Route::get('pelanggan','PelangganController@index');

Route::post('tambahkontrak','DetilKontrakController@store');
Route::post('editkontrak','DetilKontrakController@save');
Route::get('kontrak/create','DetilKontrakController@create');
Route::get('kontrak/edit/{nipnas}','DetilKontrakController@edit');
Route::get('kontrak/delete/{nipnas}','DetilKontrakController@delete');
Route::get('kontrak','DetilKontrakController@index');

Route::post('admin/layanan/create','LayananController@store');
Route::post('editlayanan','LayananController@save');
//Route::get('admin/layanan/create','LayananController@create');
Route::get('layanan/edit/{id}','LayananController@edit');
Route::get('admin/layanan/delete/{id}','LayananController@delete');
Route::get('admin/layanan','LayananController@index');

Route::post('admin/perusahaan/store','AnakPerusahaanController@store');
Route::post('admin/perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@save');
Route::get('anak_perusahaans/create','AnakPerusahaanController@create');
//Route::get('admin/perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@edit');
Route::get('admin/perusahaan/delete/{id_perusahaan}','AnakPerusahaanController@delete');
Route::get('anak_perusahaans','AnakPerusahaanController@index');


Route::get('upload', function() {
  return View::make('anak_perusahaans.upload');
});
Route::post('apply/upload', 'ApplyController@upload');


