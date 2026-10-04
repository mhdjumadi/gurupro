<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Belum login
        if (!$user) {
            return $next($request);
        }

        // Super Admin bebas akses
        if ($user->hasRole('super_admin')) {
            return $next($request);
        }


        // Paket Saya tetap bisa diakses
        if ($request->is('admin/package')) {
            return $next($request);
        }

        // Payment Saya tetap bisa diakses
        if ($request->is('admin/payment')) {
            return $next($request);
        }

        // Logout harus tetap bisa dilakukan
        if ($request->is('admin/logout')) {
            return $next($request);
        }
        // Paket Saya tetap bisa diakses
        if ($request->is('admin/profile')) {
            return $next($request);
        }

        // Tidak memiliki subscription aktif
        if (!$user->activeSubscription) {
            return redirect('/admin/package');
        }

        return $next($request);
    }
}