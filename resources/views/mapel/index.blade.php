@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar Mapel</h2>

<!-- Form Tambah -->
<form action="{{ route('mapel.store') }}" method="POST" class="mb-4 flex gap-2">
    @csrf
    <input type="text" name="nama" placeholder="Nama Mapel" required class="border p-1 rounded">
    <input type="text" name="durasi" placeholder="Durasi" required class="border p-1 rounded">
    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Tambah</button>
</form>

<table class="border-collapse border w-full">
    <tr class="bg-gray-200">
        <th class="border p-2">ID</th>
        <th class="border p-2">Nama Mapel</th>
        <th class="border p-2">Durasi</th>
        <th class="border p-2">Aksi</th>
    </tr>

    @forelse($items as $mapel)
    <tr>
        <!-- Form Edit -->
        <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <td class="border p-2">{{ $mapel->id }}</td>

            <td class="border p-2">
                <input type="text" name="nama" value="{{ $mapel->nama }}" required class="border p-1 rounded w-full">
            </td>

            <td class="border p-2">
                <input type="text" name="durasi" value="{{ $mapel->durasi }}" required class="border p-1 rounded w-full">
            </td>

            <td class="border p-2 flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Simpan</button>
        </form>

        <!-- Form Hapus -->
        <form action="{{ route('mapel.destroy', $mapel->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
        </form>
            </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center p-2">Belum ada data Mapel</td>
    </tr>
    @endforelse
</table>

@endsection
