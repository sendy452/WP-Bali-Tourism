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
    return redirect('/login');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/list', 'HomeController@list_data');
Route::get('/home/calculate', 'HomeController@calculate');
Route::resource('wisata','WisataController');
Route::resource('kriteria','KriteriaController');
Route::get('/nilai/create/{wisata}', 'NilaiController@create')->name('nilai.create');
Route::post('/nilai/create/{wisata}', 'NilaiController@store')->name('nilai.create');
Route::get('/print', 'PrintController@index')->name('print');
Route::get('/user', 'UserController@index')->name('user.index');
Route::get('/user/update/{id}','UserController@edit')->name('user.edit');
Route::post('/user/update/{id}','UserController@update')->name('user.update');
Route::post('/user/delete/{id}','UserController@destroy')->name('user.delete');
Route::post('/user/store','UserController@store')->name('user.store');
Route::post('/user/chpassword/{id}','UserController@chpassword')->name('user.chpassword');
Route::resource('jarak','JarakController');
