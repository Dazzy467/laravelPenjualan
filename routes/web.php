<?php

use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Definisi route view login dan register
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:0']], function () {
    // Admin routes go here
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.show');
    Route::get('/admin/ManageUser', [App\Http\Controllers\AdminController::class, 'manageuser'])->name('admin.manageuser');
    Route::get('/CreateUser/add', [App\Http\Controllers\AdminController::class, 'adduser_form'])->name('admin.adduser_form');
    Route::post('/CreateUser', [App\Http\Controllers\AdminController::class, 'adduser'])->name('admin.adduser');
    Route::get('/EditUser/{user}', [App\Http\Controllers\AdminController::class, 'edituser_form'])->name('admin.edituser_form');
    Route::post('/EditUser', [App\Http\Controllers\AdminController::class, 'edituser'])->name('admin.edituser');
    Route::get('/DeleteUser/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.deleteuser');
});

Route::group(['middleware' => ['auth','role:1']], function() {
    Route::get('/kasir',[App\Http\Controllers\KasirController::class,'dashboard'])->name('kasir.show');
    Route::get('/kasir/stokBarang',[\App\Http\Controllers\KasirController::class,'cekStokBarang'])->name('kasir.cekStok');
    Route::post('/kasir/BuatTransaksi',[\App\Http\Controllers\KasirController::class,'buatTransaksi']);
    Route::post('/kasir/TambahBarangKeTransaksi',[\App\Http\Controllers\KasirController::class,'tambahBarangKeTransaksi']);
    Route::get('/kasir/simpanTransaksi',[\App\Http\Controllers\KasirController::class,'simpanTransaksi']);
});