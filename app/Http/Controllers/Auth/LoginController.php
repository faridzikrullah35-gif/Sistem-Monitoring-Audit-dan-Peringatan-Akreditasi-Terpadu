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

            $user = Auth::user();

            // ==================================================
            // ADMIN
            // ==================================================
            if ($user->role === 'admin') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            // ==================================================
            // AUDITOR
            // ==================================================
            if ($user->role === 'auditor') {
                return redirect()
                    ->route('auditor.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            // ==================================================
            // UNIT KERJA LPM
            // Role tetap unit_kerja, tetapi LPM memiliki
            // akses/dashboard Admin.
            // ==================================================
            if (
                $user->role === 'unit_kerja' &&
                strcasecmp(trim($user->unit), 'LPM') === 0
            ) {
                return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            // ==================================================
            // PRODI & UNIT KERJA LAINNYA
            // Sama-sama menggunakan Dashboard Auditee.
            // ==================================================
            if (in_array($user->role, ['prodi', 'unit_kerja'])) {
                return redirect()
                    ->route('prodi.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            // ==================================================
            // FAKULTAS
            // ==================================================
            if ($user->role === 'fakultas') {
                return redirect()
                    ->route('fakultas.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            abort(403);
        }

        return redirect()
            ->route('login')
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