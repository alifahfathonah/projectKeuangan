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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/pengeluaran', 'HomeController@pengeluaran');
Route::post('/home/pengeluaran', 'HomeController@svpengeluaran');
Route::get('/home/keuangan/jasa', 'HomeController@jasa');
//
Route::get('/home/keuangan/penggajian', 'HomeController@penggajian');
Route::post('/home/keuangan/penggajian', 'HomeController@svpenggajian');
Route::get('/home/keuangan/{id}/editpenggajian', 'HomeController@editpenggajian');
Route::put('/home/keuangan/{id}/editpenggajian', 'HomeController@uppenggajian');
Route::delete('/home/keuangan/{id}/editpenggajian', 'HomeController@delpenggajian');
//
Route::post('/home/keuangan/jasa', 'HomeController@svjasa');
Route::get('/home/keuangan/les', 'HomeController@les');
Route::get('/home/keuangan/{id}/editles', 'HomeController@updles');
Route::put('/home/keuangan/{id}/editles', 'HomeController@uples');
Route::post('/home/keuangan/les', 'HomeController@svles');
Route::get('/home/laporan/harian', 'HomeController@lharian');
Route::post('/home/laporan/harian', 'HomeController@lharian');
Route::get('/home/laporan/bulanan', 'HomeController@lbulanan');
Route::post('/home/laporan/bulanan', 'HomeController@lbulanan');
Route::get('/home/laporan/tahunan', 'HomeController@ltahunan');
Route::get('/home/setting', 'HomeController@setting');
Route::get('/home/pencarian/data', 'HomeController@pencariandata');
Route::put('/home/setting', 'HomeController@upsetting');
Route::post('/home/laporan/tahunan', 'HomeController@ltahunan');
Route::get('/home/keuangan/{lokasi}/{id}/edit', 'HomeController@cekedit');
Route::put('/home/keuangan/{lokasi}/{id}/edit', 'HomeController@updata');
Route::delete('/home/keuangan/{lokasi}/{id}/delete', 'HomeController@deldata');


Route::get('/home/keuangan/program/mahasiswa', 'HomeController@pprogram');
Route::get('/home/keuangan/program/pemerintah/swasta', 'HomeController@pprogram');
Route::get('/home/keuangan/{id}/editprogram', 'HomeController@editpprogram');
Route::put('/home/keuangan/{id}/editprogram', 'HomeController@uppprogram');
Route::post('/home/keuangan/program', 'HomeController@svpprogram');

//
Route::get('/home/keuangan/trans/{id}', 'HomeController@edtrans');
Route::put('/home/keuangan/trans/{id}', 'HomeController@uptrans');
Route::delete('/home/keuangan/trans/{id}', 'HomeController@deltrans');
//
Route::get('/home/pengeluaran/{id}/edit', 'HomeController@edpengeluaran');
Route::put('/home/pengeluaran/{id}/edit', 'HomeController@uppengeluaran');
Route::delete('/home/pengeluaran/{id}/delete', 'HomeController@delpengeluaran');
