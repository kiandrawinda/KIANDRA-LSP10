<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles  Role(s) allowed, e.g. 'admin,guru' or 'admin'
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // jika belum login
        if (!$user) {
            return redirect()->route('login');
        }

        // pecah parameter multi-role "admin,guru" jadi array
        $roles = collect($roles)
            ->flatMap(fn($r) => explode(',', $r)) // support "admin,guru"
            ->map(fn($r) => trim(strtolower($r))) // trim & lowercase
            ->toArray();

        $userRole = strtolower($user->role ?? '');

        // jika role sesuai, lanjut
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // log untuk debugging (opsional)
        \Log::warning("Unauthorized access attempt: user={$user->email}, role={$userRole}, allowed=".implode(',', $roles));

        // kembalikan response 403 dengan pesan friendly
        abort(403, 'Access denied: Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}


