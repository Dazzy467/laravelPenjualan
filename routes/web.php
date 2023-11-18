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

    Route::get('/admin/grafikPenjualan', [App\Http\Controllers\AdminController::class, 'grafikPenjualan'])->name('admin.grafikPenjualan');
});

Route::group(['middleware' => ['auth','role:1']], function() {
    Route::get('/kasir',[App\Http\Controllers\KasirController::class,'dashboard'])->name('kasir.show');
    Route::get('/kasir/cekRiwayatTransaksi',[App\Http\Controllers\KasirController::class,'cekRiwayatTransaksi'])->name('kasir.cekRiwayatTrans');
    Route::get('/kasir/stokBarang',[\App\Http\Controllers\KasirController::class,'cekStokBarang'])->name('kasir.cekStok');
    Route::post('/kasir/BuatTransaksi',[\App\Http\Controllers\KasirController::class,'buatTransaksi']);
    Route::post('/kasir/TambahBarangKeTransaksi',[\App\Http\Controllers\KasirController::class,'tambahBarangKeTransaksi']);
    Route::get('/kasir/simpanTransaksi',[\App\Http\Controllers\KasirController::class,'simpanTransaksi']);
    Route::post('/kasir/HapusBarangTransaksi',[\App\Http\Controllers\KasirController::class,'hapusBarangTransaksi']);
});

Route::group(['middleware' => ['auth','role:2']], function(){
    Route::get('/gudang',[App\Http\Controllers\GudangController::class,'dashboard'])->name('gudang.show');
    
    Route::get('/gudang/KelolaBarang',[App\Http\Controllers\GudangController::class,'kelolaBarang'])->name('gudang.kelolabarang');
    Route::get('/gudang/EditBarang/{barang}',[App\Http\Controllers\GudangController::class,'editBarang_form'])->name('gudang.editbarangform');
    Route::post('/gudang/EditBarang',[App\Http\Controllers\GudangController::class,'editBarang'])->name('gudang.editbarang');
    Route::get('gudang/TambahBarangForm/',[App\Http\Controllers\GudangController::class,'addBarang_form']);
    Route::post('gudang/TambahBarang',[App\Http\Controllers\GudangController::class,'addBarang'])->name('gudang.tambahbarang');
    Route::get('/gudang/DeleteBarang/{barang}',[App\Http\Controllers\GudangController::class,'deleteBarang']);

    Route::get('/gudang/KelolaSupplier',[App\Http\Controllers\GudangController::class,'kelolaSupplier'])->name('gudang.kelolasupplier');
    Route::get('/gudang/TambahSupplierForm',[App\Http\Controllers\GudangController::class,'addSupplier_form']);
    Route::post('/gudang/TambahSupplier',[App\Http\Controllers\GudangController::class,'addSupplier'])->name('gudang.tambahsupplier');
    Route::get('/gudang/EditSupplier/{supplier}',[App\Http\Controllers\GudangController::class,'editSupplier_form']);
    Route::post('/gudang/EditSupplier',[App\Http\Controllers\GudangController::class,'editSupplier'])->name('gudang.editsupplier');
    Route::get('/gudang/DeleteSupplier/{supplier}',[App\Http\Controllers\GudangController::class,'deleteSupplier']);
});