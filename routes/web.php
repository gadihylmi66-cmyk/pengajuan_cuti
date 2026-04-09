<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('home');
