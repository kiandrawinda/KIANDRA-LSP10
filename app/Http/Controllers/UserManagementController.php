<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('dashboard', compact('users')); // pakai dashboard.blade.php
}


    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,guru,siswa',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Role berhasil diubah.');
    }
}
