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
// Redirect Dashboard Berdasarkan Role
Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403, 'Role tidak dikenal'),
    };
})->name('dashboard');




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
// Dashboard Admin
Route::get('/admin/dashboard', [UserManagementController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');



// CRUD User
Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
Route::patch('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // Resource Controller
    Route::resource('mapel', MapelController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('nilai', NilaiController::class);
});

// ==============================
// GURU AREA
// ==============================
Route::middleware(['auth','role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/dashboard/guru', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');

    // Tambahkan fitur guru lainnya di sini
});

// ==============================
// SISWA AREA
// ==============================
Route::middleware(['auth','role:siswa'])->group(function () {

    // Dashboard Siswa
    Route::get('/dashboard/siswa', function () {
        return view('dashboard.siswa');
    })->name('siswa.dashboard');

    // Tambahkan fitur siswa lainnya di sini
});

require __DIR__.'/auth.php';
