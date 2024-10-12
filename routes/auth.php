<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::middleware('guest')->group(function () {
    // Route untuk register
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route untuk login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    // Rute untuk menampilkan halaman verifikasi email (bagi yang belum verifikasi)
    Route::get('/verify-email', [VerifyEmailController::class, 'notice'])
        ->name('verification.notice');

    // Rute untuk memverifikasi email pengguna
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Rute untuk konfirmasi password
    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});

