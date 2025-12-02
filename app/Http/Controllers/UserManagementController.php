<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
// Controller
public function index() {
    $users = User::all();
    return view('admin.users.index', compact('users')); // halaman CRUD user
}



public function dashboard() {
    $totalUsers = \App\Models\User::count();
    $totalGuru = \App\Models\User::where('role', 'guru')->count();
    $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
    $totalAdmin = \App\Models\User::where('role', 'admin')->count();

    return view('dashboard.admin', compact('totalUsers', 'totalGuru', 'totalSiswa', 'totalAdmin'));
}






public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,guru,siswa',
    ]);

    // Buat user baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
}

}
