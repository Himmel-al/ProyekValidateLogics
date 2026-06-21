<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman utama / Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// VERIFIKASI EMAIL
Route::get('/email-form', [AuthController::class, 'showEmailForm'])
    ->name('email.form');

Route::post('/email-form', [AuthController::class, 'kirimVerifikasiEmail'])
    ->name('email.kirim');

Route::get('/email-verification', [AuthController::class, 'showVerifyEmail'])
    ->name('email.verify.form');

Route::post('/email-verification', [AuthController::class, 'verifyEmail'])
    ->name('email.verify');

// OTP LOGIN
Route::get('/otp-kirim', [AuthController::class, 'kirimOtpLogin'])
    ->name('otp.kirim');

Route::get('/otp-verification', [AuthController::class, 'showOtp'])
    ->name('otp.view');

Route::post('/otp-verification', [AuthController::class, 'verifyOtp'])
    ->name('otp.proses');

// DASHBOARD
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');
