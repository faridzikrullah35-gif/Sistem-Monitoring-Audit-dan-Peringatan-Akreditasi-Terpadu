<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Menampilkan halaman manajemen role.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.admin.kelola-roles', compact('roles'));
    }

    /**
     * Menyimpan role baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:role,name',
            ],
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil ditambahkan.',
            'data' => $role,
        ]);
    }

    /**
     * Menampilkan data role untuk edit.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

    /**
     * Memperbarui role.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:role,name,' . $role->id,
            ],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diperbarui.',
            'data' => $role,
        ]);
    }

    /**
     * Menghapus role.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus.',
        ]);
    }
}