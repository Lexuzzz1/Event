<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/events', [EventController::class, 'showAll'])->name('event.all');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('event.detail');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/events/history', [EventController::class, 'showHistory'])->name('event.history');
    Route::get('/event/{event}/upload-payment', [RegistrationController::class, 'uploadForm'])->name('payment.upload');
    Route::get('/events/history', [EventController::class, 'showHistory'])->name('event.history');
    Route::post('/event/{event}/register', [RegistrationController::class, 'store'])->name('event.register');
    Route::get('/event/{event}/upload-payment', [RegistrationController::class, 'uploadForm'])->name('payment.upload');
    Route::post('/event/{event}/upload-payment', [RegistrationController::class, 'uploadPayment'])->name('payment.upload.submit');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/{user}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');
    Route::put('/user/{user}/activate', [UserController::class, 'activate'])->name('user.activate');
});

Route::middleware(['auth', 'role:panitia'])->group(function () {
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::get('/event/{event}/view', [EventController::class, 'view'])->name('event.view');
});

Route::middleware(['auth', 'role:keuangan'])->group(function () {
    Route::get('/keuangan', [RegistrationController::class, 'financeDashboard'])->name('finance.dashboard');
    Route::put('/keuangan/verify/{id}', [RegistrationController::class, 'verify'])->name('finance.verify');
});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.delete');
});
// Authentication routes
Route::middleware(['auth', 'role:keuangan'])->prefix('keuangan')->group(function () {
    Route::get('/', [FinanceController::class, 'index'])->name('keuangan.dashboard');
    Route::get('/verifikasi', [FinanceController::class, 'verifikasi'])->name('keuangan.verifikasi');
    Route::post('/verifikasi/{id}', [FinanceController::class, 'prosesVerifikasi'])->name('keuangan.verifikasi.proses');
    Route::get('/transaksi', [FinanceController::class, 'transaksi'])->name('keuangan.transaksi');
    Route::get('/laporan', [FinanceController::class, 'laporan'])->name('keuangan.laporan');
    Route::get('/bukti', [FinanceController::class, 'unduhBukti'])->name('keuangan.bukti');
    Route::get('/bukti/download/{id}', [FinanceController::class, 'downloadBukti'])->name('keuangan.bukti.download');
});



require __DIR__ . '/auth.php';
