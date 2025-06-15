<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pengguna\KalenderController;
use App\Http\Controllers\Pengguna\istiqrarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [AuthController::class, 'landingPage'])->name('landingPage');
Route::get('/register', fn() => redirect()->route('praRegister'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/kalenderHaid', [KalenderController::class, 'index'])->name('kalender.index');
    Route::post('/kalenderHaid', [KalenderController::class, 'store'])->name('kalender.store');
    Route::put('/kalenderHaid', [KalenderController::class, 'update'])->name('kalender.update');
    Route::delete('/kalenderHaid', [KalenderController::class, 'destroy'])->name('kalender.destroy');
    // Route::delete('/kalenderHaid', function () {
    // dd('route delete berhasil!')->name('kalender.destroy');
});


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/dashboard', [istiqrarController::class, 'store'])->name('istiqrar.store');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/pra-register', [AuthController::class, 'showPraRegister'])->name('praRegister');
Route::post('/pra-register', [AuthController::class, 'store'])->name('pra-register.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);
