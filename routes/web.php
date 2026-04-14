<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HasilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::resource('cuti', CutiController::class);
Route::resource('hasil', HasilController::class);


Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/admin/karyawan', KaryawanController::class, ['as' => 'admin']);
Route::resource('/admin/hasiladmin', HasilAdminController::class, ['as' => 'admin']);
Route::resource('/admin/jabatan', JabatanController::class, ['as' => 'admin']);
