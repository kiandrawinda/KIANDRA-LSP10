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
Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match($role) {
        'admin'       => redirect()->route('admin.users.index'),
        'distributor' => redirect()->route('distributor.dashboard'),
        'pelanggan'   => redirect()->route('pelanggan.dashboard'),
        default       => abort(403, 'Role tidak dikenal'),
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
// ADMIN AREA (dulu Karyawan)
// ==============================
Route::middleware(['auth','role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function() {
        return redirect()->route('admin.users.index');
    })->name('admin.dashboard');

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
// DISTRIBUTOR AREA (dulu Kasir)
// ==============================
Route::middleware(['auth','role:distributor'])->group(function () {

    // Dashboard Distributor
    Route::get('/dashboard/distributor', function () {
        return view('dashboard.distributor'); // buat view baru
    })->name('distributor.dashboard');

    // Tambahkan fitur distributor lainnya di sini
});

// ==============================
// PELANGGAN AREA (dulu Siswa)
// ==============================
Route::middleware(['auth','role:pelanggan'])->group(function () {

    // Dashboard Pelanggan
    Route::get('/dashboard/pelanggan', function () {
        return view('dashboard.pelanggan');
    })->name('pelanggan.dashboard');

    // Tambahkan fitur pelanggan lainnya di sini
});

require __DIR__.'/auth.php';
