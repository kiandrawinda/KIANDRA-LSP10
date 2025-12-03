@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-12 px-6">
    <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 2rem; text-align: center; color: #111;">
        Dashboard Admin
    </h1>


<!-- Dashboard Cards Compact -->
<div class="dashboard-stats" style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center; margin-bottom:3rem;">

    <!-- Card Users -->
    <div class="card card-users">
        <div class="icon">👥</div>
        <div class="text">
            <div class="label">Total Users</div>
            <div class="value">{{ $totalUsers }}</div>
        </div>
    </div>

    <!-- Card Admin -->
    <div class="card card-admin">
        <div class="icon">👔</div>
        <div class="text">
            <div class="label">Total Admin</div>
            <div class="value">{{ $totalAdmin }}</div>
        </div>
    </div>

    <!-- Card Distributor -->
    <div class="card card-distributor">
        <div class="icon">💰</div>
        <div class="text">
            <div class="label">Total Distributor</div>
            <div class="value">{{ $totalDistributor }}</div>
        </div>
    </div>

    <!-- Card Pelanggan -->
    <div class="card card-pelanggan">
        <div class="icon">🛒</div>
        <div class="text">
            <div class="label">Total Pelanggan</div>
            <div class="value">{{ $totalPelanggan }}</div>
        </div>
    </div>
</div>

@php
    $maxValue = max($totalUsers, $totalAdmin, $totalDistributor, $totalPelanggan);
    $scale = 400 / $maxValue;
    $minWidth = 50;
@endphp

<!-- Diagram Horizontal -->
<div class="horizontal-chart" style="display:flex; flex-direction:column; gap:15px; max-width:700px; margin:0 auto 3rem;">
    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:100px; font-weight:bold;">Users</span>
        <div style="background:#8b5cf6; height:30px; width:{{ max($totalUsers * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalUsers }}"></div>
    </div>
    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:100px; font-weight:bold;">Admin</span>
        <div style="background:#10b981; height:30px; width:{{ max($totalAdmin * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalAdmin }}"></div>
    </div>
    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:100px; font-weight:bold;">Distributor</span>
        <div style="background:#3b82f6; height:30px; width:{{ max($totalDistributor * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalDistributor }}"></div>
    </div>
    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:100px; font-weight:bold;">Pelanggan</span>
        <div style="background:#ef4444; height:30px; width:{{ max($totalPelanggan * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalPelanggan }}"></div>
    </div>
</div>

<h2 class="text-2xl font-bold mb-4">Daftar User</h2>

@php
    $roles = ['admin', 'distributor', 'pelanggan'];
@endphp

{{-- Form Tambah User --}}
<form action="{{ route('admin.users.store') }}" method="POST" class="mb-4 flex gap-2 flex-wrap">
    @csrf
    <input type="text" name="name" placeholder="Nama User" required class="border p-2 rounded w-48">
    <input type="email" name="email" placeholder="Email User" required class="border p-2 rounded w-64">
    <input type="password" name="password" placeholder="Password" required class="border p-2 rounded w-48">

    <select name="role" required class="border p-2 rounded w-48">
        <option value="">Pilih Role</option>
        @foreach($roles as $role)
            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
</form>

{{-- Table Daftar User --}}
<table class="border-collapse border w-full">
    <tr class="bg-gray-200">
        <th class="border p-2">ID</th>
        <th class="border p-2">Nama</th>
        <th class="border p-2">Email</th>
        <th class="border p-2">Role</th>
        <th class="border p-2">Aksi</th>
    </tr>

    @forelse($users as $user)
        <tr>
            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <td class="border p-2">{{ $user->id }}</td>
                <td class="border p-2">
                    <input type="text" name="name" value="{{ $user->name }}" required class="border p-1 rounded w-48">
                </td>
                <td class="border p-2">
                    <input type="email" name="email" value="{{ $user->email }}" required class="border p-1 rounded w-64">
                </td>
                <td class="border p-2">
                    <select name="role" required class="border p-1 rounded w-48">
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="border p-2 flex gap-2">
                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Simpan</button>
            </form>

            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </form>
                </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center p-2">Belum ada data User</td>
        </tr>
    @endforelse
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>



</div>

<style>
.dashboard-stats .card {
    flex: 1 1 200px;
    display: flex;
    align-items: center;
    padding: 20px;
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s;
    cursor: pointer;
    min-width: 180px;
    max-width: 300px;
}

.dashboard-stats .card:hover {
    transform: translateY(-4px) scale(1.02);
}

.dashboard-stats .icon {
    font-size: 2rem;
    margin-right: 15px;
}

.dashboard-stats .text .label {
    font-size: 0.9rem;
    font-weight: bold;
}

.dashboard-stats .text .value {
    font-size: 2rem;
    font-weight: 700;
}

/* Warna Card */
.card-users { background: #8b5cf6; }
.card-admin { background: #10b981; }
.card-distributor { background: #3b82f6; }
.card-pelanggan { background: #ef4444; }
</style>

@endsection
