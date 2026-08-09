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

        // =========================
        // SEARCH
        // =========================
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // =========================
        // FILTER ROLE
        // =========================
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // =========================
        // FILTER UNIT
        // =========================
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // =========================
        // FILTER SUB UNIT
        // =========================
        if ($request->filled('sub_unit')) {
            $query->where('sub_unit', $request->sub_unit);
        }

        $users = $query
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Dropdown
        $roles = User::select('role')
            ->distinct()
            ->orderBy('role')
            ->pluck('role');

        $units = User::whereNotNull('unit')
            ->where('unit', '!=', '')
            ->distinct()
            ->orderBy('unit')
            ->pluck('unit');

        $subUnits = User::whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '')
            ->distinct()
            ->orderBy('sub_unit')
            ->pluck('sub_unit');

        // AJAX
        if ($request->ajax()) {

            $html = view('components.user.data-table', compact('users'))->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        }

        return view('pages.pengguna.pengguna', compact(
            'users',
            'roles',
            'units',
            'subUnits'
        ));
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

    public function getSubUnit(Request $request)
    {
        $subUnits = User::query()
            ->whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '');

        if ($request->unit) {
            $subUnits->where('unit', $request->unit);
        }

        return response()->json(
            $subUnits
                ->select('sub_unit')
                ->distinct()
                ->orderBy('sub_unit')
                ->pluck('sub_unit')
        );
    }
}