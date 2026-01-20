<?php

use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\RepschoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RepschoolController::class, 'index'])->name('home');
Route::post('/aspirasi', [RepschoolController::class, 'store'])->name('aspirasi.store');
Route::get('/status', [RepschoolController::class, 'status'])->name('aspirasi.status');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.store');

Route::middleware('admin')->group(function () {
    Route::get('/admin/aspirasi', [AdminAspirasiController::class, 'index'])->name('admin.aspirasi.index');
    Route::patch('/admin/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])->name('admin.aspirasi.update');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
