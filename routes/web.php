<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_action', [AuthController::class, 'login_action'])->name('login_action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'categories' => CategoryController::class,
        'distributors' => DistributorController::class,
        'items' => ItemController::class,
        'users' => UserController::class,
    ]);

    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan');
    Route::get('/laporan/semua', [ReportController::class, 'semua']);
    Route::get('/laporan/cetak_semua', [ReportController::class, 'cetak_semua']);

    Route::get('/pengaturan', [PengaturanController::class, 'index']);
    Route::put('/update_username', [PengaturanController::class, 'update_username']);
    Route::put('/update_password', [PengaturanController::class, 'update_password']);
    Route::put('/update_foto', [PengaturanController::class, 'update_foto']);
});
