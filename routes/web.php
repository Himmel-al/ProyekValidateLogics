<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman utama / Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// --- RUTE BARU UNTUK MINTA EMAIL ---
Route::get('/otp-request-method', [AuthController::class, 'showMintaEmail'])->name('otp.minta_email');
Route::post('/otp-request-method', [AuthController::class, 'prosesMintaEmail'])->name('otp.proses_minta_email');

// Verifikasi OTP (Masih pakai rute lama)
Route::get('/otp-verification', [AuthController::class, 'showOtp'])->name('otp.view');
Route::post('/otp-verification', [AuthController::class, 'verifyOtp'])->name('otp.proses');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
