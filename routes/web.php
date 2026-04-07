<?php

use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepschoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [RepschoolController::class, 'index'])->name('home');
    Route::post('/aspirasi', [RepschoolController::class, 'store'])->name('aspirasi.store');
    Route::get('/status', [RepschoolController::class, 'status'])->name('aspirasi.status');

    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/aspirasi', [AdminAspirasiController::class, 'index'])->name('admin.aspirasi.index');
        Route::patch('/admin/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])->name('admin.aspirasi.update');
    });
});
