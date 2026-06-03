<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingScore;

class SettingScoreController extends Controller
{
    /**
     * Halaman utama
     */
    public function index()
    {
        $settingScores = SettingScore::orderBy('id')->get();

        return view('pages.setting-skor', compact('settingScores'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'score_value' => [
                'required',
                'regex:/^\d+(\s*-\s*\d+)?$/'
            ],

            'description' => 'required|string|max:255',
            'generate_ncr' => 'nullable|boolean',
        ]);

        SettingScore::create([
            'nilai_score' => $request->score_value,
            'keterangan' => $request->description,
            'generate_ncr' => $request->boolean('generate_ncr'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $settingScore = SettingScore::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $settingScore
        ]);
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'score_value' => [
                'required',
                'regex:/^\d+(\s*-\s*\d+)?$/'
            ],

            'description' => 'required|string|max:255',
            'generate_ncr' => 'nullable|boolean',
        ]);

        $settingScore = SettingScore::findOrFail($id);

        $settingScore->update([
            'nilai_score' => $request->score_value,
            'keterangan' => $request->description,
            'generate_ncr' => $request->boolean('generate_ncr'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $settingScore = SettingScore::findOrFail($id);

        $settingScore->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}