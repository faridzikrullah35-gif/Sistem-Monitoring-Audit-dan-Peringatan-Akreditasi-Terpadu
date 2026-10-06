<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // =========================
    // LIST USER
    // =========================
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // FILTER ROLE
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // FILTER UNIT
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // FILTER SUB UNIT
        if ($request->filled('sub_unit')) {
            $query->where('sub_unit', $request->sub_unit);
        }

        $users = $query
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        // =========================
        // DROPDOWN ROLE
        // Ambil dari tabel role
        // =========================
        $roles = Role::orderBy('id', 'asc')->get();

        // =========================
        // DROPDOWN UNIT
        // =========================
        $units = User::whereNotNull('unit')
            ->where('unit', '!=', '')
            ->distinct()
            ->orderBy('unit')
            ->pluck('unit');

        // =========================
        // DROPDOWN SUB UNIT
        // =========================
        $subUnits = User::whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '')
            ->distinct()
            ->orderBy('sub_unit')
            ->pluck('sub_unit');

        // =========================
        // AJAX
        // =========================
        if ($request->ajax()) {
            $html = view(
                'components.user.data-table',
                compact('users')
            )->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        }

        return view(
            'pages.pengguna.pengguna',
            compact(
                'users',
                'roles',
                'units',
                'subUnits'
            )
        );
    }


    // =========================
    // STORE USER
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => 'required|min:8|confirmed',

            // Role harus ada di tabel role
            'role' => [
                'required',
                Rule::exists('role', 'name'),
            ],

            'unit' => 'nullable|string|max:255',

            'sub_unit' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make(
            $validated['password']
        );

        $user = User::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'user' => $user
            ]);
        }

        return back()->with(
            'success',
            'User berhasil ditambahkan'
        );
    }


    // =========================
    // SHOW USER
    // =========================
    public function show($id)
    {
        return response()->json(
            User::findOrFail($id)
        );
    }


    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
            ],

            'password' => 'nullable|min:8|confirmed',

            // Role harus ada di tabel role
            'role' => [
                'required',
                Rule::exists('role', 'name'),
            ],

            'unit' => 'nullable|string|max:255',

            'sub_unit' => 'nullable|string|max:255',
        ]);

        // Kalau password diisi, hash password baru
        if (!empty($validated['password'])) {

            $validated['password'] = Hash::make(
                $validated['password']
            );

        } else {

            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
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
                'success' => true,
                'message' => 'User berhasil dihapus'
            ]);
        }

        return back()->with(
            'success',
            'User berhasil dihapus'
        );
    }


    // =========================
    // STORE ROLE
    // Tambah Hak Akses User
    // =========================
    public function storeRole(Request $request)
    {
        $validated = $request->validate([

            'user_id' => [
                'required',
                'exists:users,id',
            ],

            // Role dari database
            'role' => [
                'required',
                Rule::exists('role', 'name'),
            ],

            'unit' => 'nullable|string|max:255',

            'sub_unit' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail(
            $validated['user_id']
        );

        $user->update([
            'role' => $validated['role'],
            'unit' => $validated['unit'] ?? null,
            'sub_unit' => $validated['sub_unit'] ?? null,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hak akses berhasil ditambahkan untuk ' . $user->name,
                'user' => $user
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Hak akses berhasil ditambahkan untuk ' . $user->name
            );
    }


    // =========================
    // UPDATE ROLE
    // Edit Hak Akses User
    // =========================
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([

            // Role dari database
            'role' => [
                'required',
                Rule::exists('role', 'name'),
            ],

            'unit' => 'nullable|string|max:255',

            'sub_unit' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hak akses berhasil diperbarui untuk ' . $user->name,
                'user' => $user
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Hak akses berhasil diperbarui untuk ' . $user->name
            );
    }


    // =========================
    // DELETE ROLE
    // Hapus Hak Akses User
    // =========================
    public function deleteRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => null,
            'unit' => null,
            'sub_unit' => null
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hak akses berhasil dihapus untuk ' . $user->name,
                'user' => $user
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Hak akses berhasil dihapus untuk ' . $user->name
            );
    }


    // =========================
    // GET SUB UNIT
    // =========================
    public function getSubUnit(Request $request)
    {
        $subUnits = User::query()
            ->whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '');

        if ($request->unit) {
            $subUnits->where(
                'unit',
                $request->unit
            );
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