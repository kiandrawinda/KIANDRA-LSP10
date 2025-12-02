@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar Guru</h2>

<!-- Form Tambah Guru -->
<form action="{{ route('guru.store') }}" method="POST" class="mb-4 flex gap-2 flex-wrap">
    @csrf
    <input type="text" name="nama" placeholder="Nama Guru" required class="border p-1 rounded w-48">
    <input type="email" name="email" placeholder="Email Guru" class="border p-1 rounded w-64">
    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah</button>
</form>

<table class="border-collapse border w-full">
    <tr class="bg-gray-200">
        <th class="border p-2">ID</th>
        <th class="border p-2">Nama</th>
        <th class="border p-2">Email</th>
        <th class="border p-2">Aksi</th>
    </tr>

    @forelse($items as $guru)
    <tr>

        <!-- Form Edit Guru -->
        <form action="{{ route('guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')

            <td class="border p-2">{{ $guru->id }}</td>

            <td class="border p-2">
                <input type="text" name="nama" value="{{ $guru->nama }}" required class="border p-1 rounded w-48">
            </td>

            <td class="border p-2">
                <input type="email" name="email" value="{{ $guru->email }}" class="border p-1 rounded w-64">
            </td>

            <td class="border p-2 flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Simpan</button>
        </form>

        <!-- Form Hapus Guru -->
        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
        </form>

            </td>
    </tr>

    @empty
    <tr>
        <td colspan="4" class="text-center p-2">Belum ada data Guru</td>
    </tr>
    @endforelse
</table>

@endsection
