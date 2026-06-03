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
        // cek login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // cek role
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}