<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // =====================================================
        // CEK LOGIN
        // =====================================================
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // =====================================================
        // KHUSUS AKSES ADMIN
        // =====================================================
        // Admin asli:
        // role = admin
        //
        // Admin LPM:
        // role = unit_kerja
        // unit = LPM
        //
        // Keduanya boleh mengakses route dengan:
        // role:admin
        // =====================================================
        if (in_array('admin', $roles) && $user->isAdminAccess()) {
            return $next($request);
        }

        // =====================================================
        // ROLE NORMAL
        // =====================================================
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // =====================================================
        // TIDAK MEMILIKI AKSES
        // =====================================================
        abort(403, 'Anda tidak memiliki akses.');
    }
}