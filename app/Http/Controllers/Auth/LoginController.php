<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
           if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil!');
        }

        if (Auth::user()->role === 'auditor') {
            return redirect()->route('auditor.dashboard')
                ->with('success', 'Login berhasil!');
        }

        if (Auth::user()->role === 'prodi') {
            return redirect()->route('prodi.dashboard')
                ->with('success', 'Login berhasil!');
        }

        if (Auth::user()->role === 'unit_kerja') {
            return redirect()->route('auditor.dashboard')
                ->with('success', 'Login berhasil!');
        }

        abort(403);
        }

        return redirect()->route('login')
            ->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}