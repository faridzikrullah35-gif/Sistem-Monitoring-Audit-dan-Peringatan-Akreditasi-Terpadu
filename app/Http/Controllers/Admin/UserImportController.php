<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserImportController extends Controller
{
    /**
     * Download template Excel user.
     */
    public function downloadTemplate()
    {
        $path = storage_path(
            'app/templates/template_import_user.xlsx'
        );

        if (!file_exists($path)) {
            abort(404, 'Template Excel tidak ditemukan.');
        }

        return response()->download(
            $path,
            'template_import_user.xlsx',
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        );
    }

    /**
     * Import user dari file Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'max:10240',
            ],
        ], [
            'file.required' =>
                'Silakan pilih file Excel terlebih dahulu.',

            'file.file' =>
                'File yang diupload tidak valid.',

            'file.mimes' =>
                'File harus berformat .xlsx atau .xls.',

            'file.max' =>
                'Ukuran file maksimal 10 MB.',
        ]);

        try {

            Excel::import(
                new UsersImport,
                $request->file('file')
            );

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON RESPONSE
            |--------------------------------------------------------------------------
            */

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna berhasil diimport.',
                ], 200);
            }

            /*
            |--------------------------------------------------------------------------
            | NORMAL REQUEST
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Data pengguna berhasil diimport.'
                );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON ERROR
            |--------------------------------------------------------------------------
            */

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Import pengguna gagal.',
                    'error' => $e->getMessage(),
                ], 422);
            }

            /*
            |--------------------------------------------------------------------------
            | NORMAL REQUEST ERROR
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Import pengguna gagal: ' .
                    $e->getMessage()
                );
        }
    }
}