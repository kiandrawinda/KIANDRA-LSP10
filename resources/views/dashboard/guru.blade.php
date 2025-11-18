<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 p-4 bg-gray-100 dark:bg-gray-800">
            <ul class="space-y-3">
                <li><a href="{{ route('dashboard') }}" class="hover:text-yellow-300">Dashboard</a></li>

                @if(auth()->user()->role == 'guru')
                    <li><a href="{{ route('guru.dashboard') }}" class="hover:text-yellow-300">Dashboard Guru</a></li>
                @endif
            </ul>
        </aside>

        <!-- Konten utama -->
        <main class="flex-1 p-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
