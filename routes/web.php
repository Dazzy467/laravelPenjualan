<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:0']], function () {
    // Admin routes go here
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.show');
    Route::get('/CreateUser/add', [App\Http\Controllers\AdminController::class, 'adduser_form'])->name('admin.adduser_form');
    Route::post('/CreateUser', [App\Http\Controllers\AdminController::class, 'adduser'])->name('admin.adduser');
    Route::get('/EditUser/{user}', [App\Http\Controllers\AdminController::class, 'edituser_form'])->name('admin.edituser_form');
    Route::post('/EditUser', [App\Http\Controllers\AdminController::class, 'edituser'])->name('admin.edituser');
    Route::get('/DeleteUser/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.deleteuser');
});