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

//Route::resource('acc-mgr', 'AccountManagerController');

Route::get('acc-mgr', 'AccountManagerController@index');
Route::get('acc-mgr/create', 'AccountManagerController@create');
Route::post('acc-mgr/store', 'AccountManagerController@store');
Route::get('acc-mgr/edit/{id}', 'AccountManagerController@edit');
Route::post('acc-mgr/update', 'AccountManagerController@update');
Route::get('acc-mgr/delete/{id}', 'AccountManagerController@delete');
