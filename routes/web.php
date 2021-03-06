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
        Route::post('pelanggan/store','PelangganController@store');
        Route::post('pelanggan/edit/{nipnas}','PelangganController@save');
        Route::get('pelanggan/delete/{nipnas}','PelangganController@delete');

        Route::get('/perusahaan/create', 'AnakPerusahaanController@create')->name('addprshn');
        Route::post('perusahaan/store','AnakPerusahaanController@store');
        Route::post('perusahaan/edit/{id_perusahaan}','AnakPerusahaanController@save');
        Route::get('perusahaan/delete/{id_perusahaan}','AnakPerusahaanController@delete');
        
        Route::post('/layanan/store', 'LayananController@store')->name('addlyn');
        Route::post('layanan/edit/{id}','LayananController@save');
        Route::get('layanan/delete/{id}','LayananController@delete');

        
        Route::get('/upload', 'DetilKontrakController@create')->name('upload');
        Route::post('upload/store','DetilKontrakController@store');
        Route::get('kontrak/edit/{id_detil}','DetilKontrakController@edit');
        Route::get('kontrak/delete/{id_detil}','DetilKontrakController@delete');
        Route::post('kontrak/save', 'DetilKontrakController@save');

        Route::get('/accmgr/create', 'AccountManagerController@create')->name('addaccmgr');
        Route::post('accmgr/store', 'AccountManagerController@store');
        Route::post('accmgr/edit/{id}', 'AccountManagerController@update');
        Route::get('accmgr/delete/{id}', 'AccountManagerController@delete');

        Route::post('/imes/store', 'LayananImesController@store')->name('addimes');
        Route::post('imes/edit/{id}', 'LayananImesController@save');
        Route::get('imes/delete/{id}', 'LayananImesController@delete');
        
        Route::post('sid/store', 'DaftarSidController@store');
        Route::get('/sid/create', 'DaftarSidController@create')->name('addsid');
        Route::get('/sid/edit/{id}', 'DaftarSidController@edit');
        Route::post('sid/save/{id}', 'DaftarSidController@save');
        Route::get('sid/delete/{id}', 'DaftarSidController@delete');

        Route::get('notifikasi/{id}','NotifikasiController@edit')->name('editnotif');
        Route::post('notifikasi/save','NotifikasiController@save');

        Route::get('kontrak/merah','DetilKontrakController@merah')->name('merah');
        Route::get('kontrak/kuning','DetilKontrakController@kuning')->name('kuning');
        Route::get('kontrak/hijau','DetilKontrakController@hijau')->name('hijau');
    });

    Route::get('/home', 'DetilKontrakController@index')->name('home');
    Route::get('kontrak/download/{nama_dokumen}','DetilKontrakController@download');
    Route::get('home/search','DetilKontrakController@search');
    //Route::get('kontrak/notifikasi','DetilKontrakController@notif');

    Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
    
    Route::get('/perusahaan', 'AnakPerusahaanController@index')->name('perusahaan');
    
    Route::get('/layanan', 'LayananController@index')->name('layanan');
    
    Route::get('/accmgr', 'AccountManagerController@index')->name('accmgr');
    
    Route::get('/imes', 'LayananImesController@index')->name('imes');
    
    Route::get('/vsat', 'DaftarSidController@sid')->name('vsat');
    Route::get('/radio', 'DaftarSidController@sid')->name('radio');
    Route::get('/device', 'DaftarSidController@sid')->name('device');
    Route::get('/network', 'DaftarSidController@sid')->name('network');
    Route::get('/application', 'DaftarSidController@sid')->name('application');
    Route::get('/platform', 'DaftarSidController@sid')->name('platform');
    Route::get('/services', 'DaftarSidController@sid')->name('services');
    
    Route::get('pelanggan/search', 'SearchController@pelanggan');

    Route::get('struktur', 'TelkomController@struktur');

    Route::get('notifikasi','NotifikasiController@showwhole');
});