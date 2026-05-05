<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // =========================
        // UPDATE FOTO
        // =========================
        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profile', 'public');

            $user->photo = $path;
            $user->save();

            // kalau AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Foto berhasil diperbarui',
                    'photo' => $user->photo
                        ? asset('storage/' . $user->photo)
                        : asset('images/default-avatar.png'),
                    'user' => $user
                ]);
            }

            return back()->with('success', 'Foto berhasil diperbarui');
        }

        // =========================
        // UPDATE PROFILE
        // =========================
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        // kalau AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Profil berhasil diperbarui',
                'user' => $user
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function deletePhoto()
    {
        $user = auth()->user();

        if ($user->photo) {

            // cek & hapus file dari storage
            if (Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // reset kolom di DB
            $user->photo = null;
            $user->save();
        }

        return response()->json([
            'message' => 'Foto berhasil dihapus',
            'photo' => null
        ]);
    }

}