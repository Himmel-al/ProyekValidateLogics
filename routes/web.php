<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/email-form', [AuthController::class, 'showEmailForm'])
    ->name('email.form');

Route::post('/email-form', [AuthController::class, 'kirimVerifikasiEmail'])
    ->name('email.kirim');

Route::get('/email-verification', [AuthController::class, 'showVerifyEmail'])
    ->name('email.verify.form');

Route::post('/email-verification', [AuthController::class, 'verifyEmail'])
    ->name('email.verify');

Route::get(
    '/verify-email/{token}',
    [AuthController::class,
        'verifyEmailByLink']
)->name('email.verify.link');

Route::get('/otp-kirim', [AuthController::class, 'kirimOtpLogin'])
    ->name('otp.kirim');

Route::get('/otp-verification', [AuthController::class, 'showOtp'])
    ->name('otp.view');

Route::post('/otp-verification', [AuthController::class, 'verifyOtp'])
    ->name('otp.proses');


Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');
