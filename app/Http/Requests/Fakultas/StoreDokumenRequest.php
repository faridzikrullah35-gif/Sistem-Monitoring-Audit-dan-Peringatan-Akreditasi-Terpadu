<?php

namespace App\Http\Requests\Fakultas;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokumenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kategori' => 'required|in:RIP,RENSTRA,RENOP,MOU',
            'nama_dokumen' => 'required|string|max:255',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_revisi' => 'nullable|date|after_or_equal:tanggal_penetapan',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'kategori.required' => 'Kategori dokumen wajib dipilih.',
            'kategori.in' => 'Kategori dokumen tidak valid.',
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'file.required' => 'File dokumen wajib diunggah.',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
            'tanggal_revisi.after_or_equal' => 'Tanggal revisi harus setelah atau sama dengan tanggal penetapan.',
        ];
    }
}