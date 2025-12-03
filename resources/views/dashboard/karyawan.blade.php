@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-12 px-6">
    <h1 style="font-size: 5rem; font-weight: 900; margin-bottom: 2rem; text-align: center; color: #111;">
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

    <!-- Card Guru -->
    <div class="card card-guru">
        <div class="icon">👩‍🏫</div>
        <div class="text">
            <div class="label">Total Guru</div>
            <div class="value">{{ $totalGuru }}</div>
        </div>
    </div>

    <!-- Card Siswa -->
    <div class="card card-siswa">
        <div class="icon">👩‍🎓</div>
        <div class="text">
            <div class="label">Total Siswa</div>
            <div class="value">{{ $totalSiswa }}</div>
        </div>
    </div>

    <!-- Card Admin -->
    <div class="card card-admin">
        <div class="icon">🛡️</div>
        <div class="text">
            <div class="label">Total Admin</div>
            <div class="value">{{ $totalAdmin }}</div>
        </div>
    </div>
</div>

@php
    $maxValue = max($totalUsers, $totalGuru, $totalSiswa, $totalAdmin);
    $scale = 400 / $maxValue; // Maksimal panjang bar 400px
    $minWidth = 50; // Minimal panjang bar
@endphp

<!-- Diagram Horizontal -->
<div class="horizontal-chart" style="display:flex; flex-direction:column; gap:15px; max-width:700px; margin:0 auto;">

    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:80px; font-weight:bold;">Users</span>
        <div style="background:#8b5cf6; height:30px; width:{{ max($totalUsers * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalUsers }}"></div>
    </div>

    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:80px; font-weight:bold;">Guru</span>
        <div style="background:#10b981; height:30px; width:{{ max($totalGuru * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalGuru }}"></div>
    </div>

    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:80px; font-weight:bold;">Siswa</span>
        <div style="background:#3b82f6; height:30px; width:{{ max($totalSiswa * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalSiswa }}"></div>
    </div>

    <div style="display:flex; align-items:center; gap:10px;">
        <span style="width:80px; font-weight:bold;">Admin</span>
        <div style="background:#ef4444; height:30px; width:{{ max($totalAdmin * $scale, $minWidth) }}px; border-radius:5px;" title="{{ $totalAdmin }}"></div>
    </div>

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
.card-users { background: #8b5cf6; }  /* Ungu */
.card-guru { background: #10b981; }  /* Hijau */
.card-siswa { background: #3b82f6; }  /* Biru */
.card-admin { background: #ef4444; }  /* Merah */
</style>

@endsection
