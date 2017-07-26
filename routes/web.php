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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'DetilKontrakController@index')->name('home');

//Route::get('/admin', 'AdminControllers@index')->name('admin');

Route::get('/upload', 'DetilKontrakController@create')->name('upload');

Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
Route::get('/pelanggan/create', 'PelangganController@create')->name('addplg');
Route::get('/perusahaan', 'AnakPerusahaanController@index')->name('perusahaan');
Route::get('/perusahaan/create', 'AnakPerusahaanController@create')->name('addprshn');
Route::get('/layanan', 'LayananController@index')->name('layanan');
Route::get('/layanan/create', 'LayananController@create')->name('addlyn');
Route::get('/accmgr', 'AccountManagerController@index')->name('accmgr');
Route::get('/accmgr/create', 'AccountManagerController@create')->name('addaccmgr');

//Route::get('/upload', 'DetilKontrakController@index')->name('upload');


//Route::get('acc-mgr', 'AccountManagerController@index');
//Route::get('acc-mgr/create', 'AccountManagerController@create');
Route::post('accmgr/store', 'AccountManagerController@store');
//Route::get('admin/accmgr/edit/{id}', 'AccountManagerController@edit');
Route::post('accmgr/edit/{id}', 'AccountManagerController@update');
Route::get('accmgr/delete/{id}', 'AccountManagerController@delete');
Route::post('pelanggan/store','PelangganController@store');
Route::post('pelanggan/edit/{nipnas}','PelangganController@save');
Route::get('pelanggan/create','PelangganController@create');
//Route::get('admin/pelanggan/edit}','PelangganController@edit');
Route::get('pelanggan/delete/{nipnas}','PelangganController@delete');
//Route::get('pelanggan','PelangganController@index');

Route::post('upload/store','DetilKontrakController@store');
Route::post('editkontrak','DetilKontrakController@save');
Route::get('kontrak/create','DetilKontrakController@create');
Route::get('kontrak/edit/{id_detil}','DetilKontrakController@edit');
Route::get('kontrak/delete/{id_detil}','DetilKontrakController@delete');
Route::get('kontrak','DetilKontrakController@index');
Route::get('kontrak/download/{nama_dokumen}','DetilKontrakController@download');
Route::get('home/search','DetilKontrakController@search');
Route::get('kontrak/notifikasi','DetilKontrakController@notif');

Route::post('layanan/create','LayananController@store');
Route::post('editlayanan','LayananController@save');
//Route::get('admin/layanan/create','LayananController@create');
Route::get('layanan/edit/{id}','LayananController@edit');
Route::get('layanan/delete/{id}','LayananController@delete');
Route::get('layanan','LayananController@index');

Route::post('perusahaan/store','AnakPerusahaanController@store');
Route::post('perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@save');
Route::get('anak_perusahaans/create','AnakPerusahaanController@create');
//Route::get('admin/perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@edit');
Route::get('perusahaan/delete/{id_perusahaan}','AnakPerusahaanController@delete');
Route::get('anak_perusahaans','AnakPerusahaanController@index');


// Route::get('upload', function() {
//   return View::make('anak_perusahaans.upload');
// });
// Route::post('apply/upload', 'ApplyController@upload');
Route::get('pelanggan/search', 'SearchController@pelanggan');


Route::post('apply/upload', 'ApplyController@upload');
