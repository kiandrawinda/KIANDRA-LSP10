<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// ==============================
// Halaman Utama
// ==============================
Route::get('/', function () {
    return view('welcome');
});

// ==============================
// Redirect Dashboard Berdasarkan Role
// ==============================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403, 'Role tidak dikenal'),
    };

})->middleware(['auth'])->name('dashboard');

// ==============================
// PROFILE USER (SEMUA ROLE)
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============================
// ADMIN AREA
// ==============================
Route::middleware(['auth','role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [UserManagementController::class, 'index'])
        ->name('admin.dashboard');

    // Resource Controller
    Route::resource('mapel', MapelController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('nilai', NilaiController::class);

    // Update Role User
    Route::patch('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])
        ->name('admin.users.updateRole');
});

// ==============================
// GURU AREA
// ==============================
Route::middleware(['auth','role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/dashboard/guru', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');

    // Jika ada fitur khusus guru, bisa ditambahkan di sini
});

// ==============================
// SISWA AREA
// ==============================
Route::middleware(['auth','role:siswa'])->group(function () {

    // Dashboard Siswa
    Route::get('/dashboard/siswa', function () {
        return view('dashboard.siswa');
    })->name('siswa.dashboard');

    // Jika ada fitur khusus siswa, bisa ditambahkan di sini
});

require __DIR__.'/auth.php';
