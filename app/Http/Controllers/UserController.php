<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // =========================
    // LIST USER (Original)
    // =========================
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH (nama / email)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // FILTER STATUS
        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        // ambil role unik dari DB
        $roles = User::select('role')->distinct()->pluck('role');

        // Jika request AJAX, return JSON untuk filter
        if ($request->ajax() || $request->wantsJson()) {
            $html = view('components.user.data-table', compact('users'))->render();
            return response()->json([
                'success' => true,
                'html' => $html,
                'users' => $users,
                'pagination' => [
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                    'total' => $users->total(),
                    'links' => $users->links()->toHtml()
                ]
            ]);
        }

        return view('pages.pengguna.pengguna', compact('users', 'roles'));
    }

    // =========================
    // FILTER DATA
    // =========================
    public function filterData(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);

        // Render partial view
        $html = view('components.user.data-table', compact('users'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'users' => $users,
            'pagination' => [
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'links' => $users->links()->toHtml()
            ]
        ]);
    }

    // =========================
    // STORE USER
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,auditor,prodi,unit_kerja',

            // NEW
            'unit' => 'nullable|string|max:255',
            'sub_unit' => 'nullable|string|max:255',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'User berhasil ditambahkan',
                'user' => $user
            ]);
        }

        return back()->with('success', 'User berhasil ditambahkan');
    }

    // =========================
    // SHOW USER
    // =========================
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:admin,auditor,prodi,unit_kerja',

            // NEW
            'unit' => 'nullable|string|max:255',
            'sub_unit' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User berhasil diupdate',
            'user' => $user
        ]);
    }

    // =========================
    // DELETE USER
    // =========================
    public function destroy(Request $request, $id)
    {
        User::findOrFail($id)->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'User berhasil dihapus'
            ]);
        }

        return back()->with('success', 'User berhasil dihapus');
    }
}