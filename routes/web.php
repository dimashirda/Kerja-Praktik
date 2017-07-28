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


Route::middleware(['auth'])->group(function() {

    Route::get('/', function () {
        return redirect ('/home');
    });
    Route::middleware(['role'])->group(function(){
        Route::get('/pelanggan/create', 'PelangganController@create')->name('addplg');
        Route::get('/perusahaan/create', 'AnakPerusahaanController@create')->name('addprshn');
        Route::post('/layanan/store', 'LayananController@store')->name('addlyn');
        Route::get('/upload', 'DetilKontrakController@create')->name('upload');
        Route::get('/accmgr/create', 'AccountManagerController@create')->name('addaccmgr');
        Route::post('accmgr/store', 'AccountManagerController@store');
        Route::post('accmgr/edit/{id}', 'AccountManagerController@update');
        Route::get('accmgr/delete/{id}', 'AccountManagerController@delete');
        Route::post('pelanggan/store','PelangganController@store');
        Route::post('pelanggan/edit/{nipnas}','PelangganController@save');
        Route::get('pelanggan/delete/{nipnas}','PelangganController@delete');
        Route::post('upload/store','DetilKontrakController@store');
        Route::post('editkontrak','DetilKontrakController@save');
        Route::get('kontrak/create','DetilKontrakController@create');
        Route::get('kontrak/edit/{id_detil}','DetilKontrakController@edit');
        Route::get('kontrak/delete/{id_detil}','DetilKontrakController@delete');
        Route::post('layanan/edit/{id}','LayananController@save');
//        Route::get('layanan/edit/{id}','LayananController@edit');
        Route::get('layanan/delete/{id}','LayananController@delete');
        Route::post('perusahaan/store','AnakPerusahaanController@store');
        Route::post('perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@save');
        Route::get('anak_perusahaans/create','AnakPerusahaanController@create');
        Route::get('perusahaan/delete/{id_perusahaan}','AnakPerusahaanController@delete');
        Route::get('kontrak/edit/{id_detil}', 'DetilKontrakController@edit');
        Route::post('kontrak/save', 'DetilKontrakController@save');
        Route::get('notifikasi/edit/{id}','NotifikasiController@edit')->name('editnotif');
        Route::get('notifikasi/viewall','NotifikasiController@showwhole');
        Route::post('notifikasi/save/{id}','NotifikasiController@save');        
    });

    Route::get('/home', 'DetilKontrakController@index')->name('home');
    Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
    Route::get('/perusahaan', 'AnakPerusahaanController@index')->name('perusahaan');
    Route::get('/layanan', 'LayananController@index')->name('layanan');
    Route::get('/accmgr', 'AccountManagerController@index')->name('accmgr');
//    Route::get('kontrak','DetilKontrakController@index');
    Route::get('kontrak/download/{nama_dokumen}','DetilKontrakController@download');
    Route::get('home/search','DetilKontrakController@search');
    Route::get('kontrak/notifikasi','DetilKontrakController@notif');
    Route::get('pelanggan/search', 'SearchController@pelanggan');
    Route::get('struktur', 'TelkomController@struktur');

});
