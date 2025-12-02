@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar User</h2>

<!-- Form Tambah User -->
<form action="{{ route('admin.users.store') }}" method="POST" class="mb-4 flex gap-2 flex-wrap">
    @csrf
    <input type="text" name="name" placeholder="Nama User" required class="border p-2 rounded w-48">
    <input type="email" name="email" placeholder="Email User" required class="border p-2 rounded w-64">
    <input type="password" name="password" placeholder="Password" required class="border p-2 rounded w-48">

    <select name="role" required class="border p-2 rounded w-48">
        <option value="">Pilih Role</option>
        <option value="admin">Admin</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
</form>

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
        <!-- Form Edit User -->
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
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ $user->role === 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </td>

            <td class="border p-2 flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Simpan</button>
        </form>

        <!-- Form Hapus User -->
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

@endsection
