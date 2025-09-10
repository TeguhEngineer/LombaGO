<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role dari user yang sedang login
        $userRole = Auth::user()->role; // Pastikan ada field 'role' di tabel users

        // Cek apakah role user ada di daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            return back();
            // return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
