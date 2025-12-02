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
        @if(auth()->user()->role === 'admin')
            <div class="flex min-h-screen">
                <!-- Sidebar Admin -->
                <aside class="w-64 p-6 bg-gray-800 text-white">
                    <h2 class="text-2xl font-bold mb-6">{{ config('app.name') }}</h2>
                    <ul class="space-y-3">
                        <li><a class="hover:text-yellow-300 block" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="hover:text-yellow-300 block" href="{{ route('mapel.index') }}">Data Mapel</a></li>
             
                          <li><a class="hover:text-yellow-300 block" href="{{ route('admin.users.index') }}">Data user</a></li>                    
                    </ul>
                    <hr class="my-4 border-gray-600">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full bg-red-600 p-2 rounded mt-4">Logout</button>
                    </form>
                </aside>

                <!-- Main Content Admin -->
                <main class="flex-1 p-6 bg-gray-100">
                    @yield('content')
                </main>
            </div>

        @elseif(auth()->user()->role === 'guru' || auth()->user()->role === 'siswa')
            <!-- Sidebar Guru & Siswa (Breeze default) -->
            <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')

                <main class="p-6">
                    <h1 class="text-xl font-bold mb-4">
                        {{ auth()->user()->role === 'guru' ? 'Dashboard Guru' : 'Dashboard Siswa' }}
                    </h1>
                    @yield('content')
                </main>
            </div>
        @endif

    @else
        <!-- Belum login -->
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            @yield('content')
        </div>
    @endif

</body>
</html>
