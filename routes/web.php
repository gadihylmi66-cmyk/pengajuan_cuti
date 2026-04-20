<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilAdminController;
use App\Http\Controllers\Admin\CutiAdminController;
use App\Http\Controllers\Admin\JenisCutiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HasilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// User routes (authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('cuti', CutiController::class)->only(['index', 'store']);
    Route::resource('hasil', HasilController::class);
});

// Admin routes (authenticated + admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('karyawan', KaryawanController::class)->except(['create', 'edit', 'show']);
    Route::resource('jabatan', JabatanController::class)->except(['create', 'edit', 'show']);
    Route::resource('jenis-cuti', JenisCutiController::class)->except(['create', 'edit', 'show']);
    Route::resource('hasiladmin', HasilAdminController::class);
    Route::resource('cuti', CutiAdminController::class)->only(['index', 'destroy']);
    Route::patch('cuti/{cuti}/approve', [CutiAdminController::class, 'approve'])->name('cuti.approve');
    Route::patch('cuti/{cuti}/reject', [CutiAdminController::class, 'reject'])->name('cuti.reject');
});
