<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Standar;

class StandarController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Standar::latest()->get()
        ]);
    }

    public function getData()
    {
        $standars = Standar::orderBy('nama', 'asc')->get(['id', 'nama']);
        
        return response()->json([
            'standars' => $standars
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255'
            ]);

            $standar = Standar::create([
                'nama' => $request->nama
            ]);

            return redirect()->back()->with('success', 'Standar berhasil ditambahkan');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan standar: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $standar = Standar::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $standar
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255'
            ]);

            $standar = Standar::findOrFail($id);
            $standar->update([
                'nama' => $request->nama
            ]);

            return redirect()->back()->with('success', 'Standar berhasil diupdate');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update standar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $standar = Standar::findOrFail($id);
            $standar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Standar berhasil dihapus'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus standar'
            ], 500);
        }
    }
}