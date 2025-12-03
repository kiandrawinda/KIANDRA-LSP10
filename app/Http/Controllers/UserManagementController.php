<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        // Statistik untuk card dashboard
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDistributor = User::where('role', 'distributor')->count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        return view('admin.users.index', compact(
            'users', 'totalUsers', 'totalAdmin', 'totalDistributor', 'totalPelanggan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,distributor,pelanggan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function dashboard()
    {
        // Bisa langsung redirect ke users.index
        return redirect()->route('admin.users.index');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,distributor,pelanggan',
        ]);

        $user->update(['role' => $request->role]);
        return redirect()->route('admin.users.index')->with('success', 'Role berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
