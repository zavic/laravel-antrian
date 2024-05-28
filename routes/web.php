<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserQueueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Guest
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tentang', function () {
    return view('pages.about');
})->name('about');

Route::get('/antrian-sekarang', function () {
    return view('pages.queue-now');
})->name('queue-now');

Auth::routes();

// User
Route::middleware('auth')->group(function () {
    Route::get('/ambil-antrian', [UserQueueController::class, 'create'])->name('user-create-queue');
    Route::post('/antrian', [UserQueueController::class, 'store'])->name('user-store-queue');
    Route::get('/antrian-saya', [UserQueueController::class, 'myQueue'])->name('user-my-queue');
    Route::get('/profil-saya', [UserProfileController::class, 'index'])->name('user-profile');
    Route::put('/profil-saya', [UserProfileController::class, 'update'])->name('user-profile-update');
    Route::post('/reset-password', [UserProfileController::class, 'resetPassword'])->name('user-reset-password');
});

// Admin and Staff
Route::middleware(['can:adminAndStaff'])->group(function () {
    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Antrian
    Route::get('/admin/antrian/list', [QueueController::class, 'index'])->name('queue-list');
    Route::get('/admin/antrian/tambah', [QueueController::class, 'create'])->name('queue-add');
    Route::post('/admin/antrian', [QueueController::class, 'store'])->name('queue-store');
    Route::get('/admin/antrian/edit/{id}', [QueueController::class, 'edit'])->name('queue-edit');
    Route::put('/admin/antrian/{id}', [QueueController::class, 'update'])->name('queue-update');
    Route::delete('/admin/antrian/{id}', [QueueController::class, 'destroy'])->name('queue-destroy');

    // Loket Antrian
    Route::get('/admin/antrian/loket', [QueueController::class, 'loket'])->name('queue-loket');

    // Panggil Antrian
    Route::get('/antrian/panggil', [QueueController::class, 'call'])->name('queue-call');

    // Layar Monitor Antrian
    Route::get('/admin/antrian/monitor', [QueueController::class, 'monitor'])->name('queue-monitor');

    // Settings
    Route::get('/admin/pengaturan', [AppSettingController::class, 'index'])->name('app-settings');
    Route::put('/admin/pengaturan', [AppSettingController::class, 'update'])->name('update-app-settings');
});

// Only Admin
Route::middleware(['can:admin'])->group(function() {
    // CRUD User
    Route::get('/admin/user/list', [UserController::class, 'index'])->name('user-list');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('user-create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('user-store');

});
