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
    return view('index');
});

Route::get('/jadwal','ControllerPeminjaman@displayJadwal');
Route::post('/login','ControllerUser@authenticate');
Route::get('/logout','ControllerUser@logout'); 
Route::post('/newbooking','ControllerPeminjaman@tambahBooking');
Route::get('/tambah','ControllerPeminjaman@tambah'); #middleware
Route::post('/verif','ControllerPeminjaman@validasi');
Route::post('/iverif','ControllerPeminjaman@invalidasi');
Route::post('/editbooking','ControllerPeminjaman@editBooking');
Route::post('/ambilkunci','ControllerKunci@kembalikanKunci');
Route::post('/kasihkunci','ControllerKunci@tambahJaminan');
Route::post('/laporan','ControllerLaporan@tambahlaporan');