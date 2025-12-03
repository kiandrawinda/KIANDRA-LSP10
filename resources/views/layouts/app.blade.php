<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Aplikasi Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

@if(auth()->check())

    @php $role = auth()->user()->role; @endphp

    <div class="flex min-h-screen">

        {{-- Sidebar untuk semua role --}}
        <aside class="w-64 p-6 bg-gray-800 text-white">
            <h2 class="text-2xl font-bold mb-6">{{ config('app.name') }}</h2>
            <ul class="space-y-3">
                @if($role === 'admin')
                    <li><a class="hover:text-yellow-300 block" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                    <li><a class="hover:text-yellow-300 block" href="{{ route('mapel.index') }}">Data Mapel</a></li>
                    <li><a class="hover:text-yellow-300 block" href="{{ route('admin.users.index') }}">Data User</a></li>
                @elseif($role === 'distributor')
                    <li><a class="hover:text-yellow-300 block" href="{{ route('distributor.dashboard') }}">Dashboard Distributor</a></li>
                    {{-- Tambahkan menu distributor lainnya --}}
                @elseif($role === 'pelanggan')
                    <li><a class="hover:text-yellow-300 block" href="{{ route('pelanggan.dashboard') }}">Dashboard Pelanggan</a></li>
                    {{-- Tambahkan menu pelanggan lainnya --}}
                @endif
            </ul>
            <hr class="my-4 border-gray-600">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 p-2 rounded mt-4">Logout</button>
            </form>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6 bg-gray-100">
            @yield('content')
        </main>

    </div>

@else
    {{-- Halaman login / guest --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        @yield('content')
    </div>
@endif

</body>
</html>
