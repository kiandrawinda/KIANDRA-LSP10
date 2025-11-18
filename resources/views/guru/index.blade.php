@extends('layouts.app')

@section('content')
<h2>Daftar Guru</h2>

<!-- Form Tambah Guru -->
<form action="{{ route('guru.store') }}" method="POST" style="margin-bottom:10px;">
    @csrf
    <input type="text" name="nama" placeholder="Nama Guru" required>
    <input type="email" name="email" placeholder="Email">
    <button type="submit">Tambah</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    @foreach($items as $guru)
    <tr>
        <form action="{{ route('guru.update', $guru->id) }}" method="POST" style="display:flex; gap:5px;">
            @csrf
            @method('PUT')
            <td>{{ $guru->id }}</td>
            <td><input type="text" name="nama" value="{{ $guru->nama }}" required></td>
            <td><input type="email" name="email" value="{{ $guru->email }}"></td>
            <td>
                <button type="submit">Simpan</button>
        </form>
        <!-- Form Hapus dipisah biar nggak nested -->
        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
            </td>
    </tr>
    @endforeach
</table>
@endsection

