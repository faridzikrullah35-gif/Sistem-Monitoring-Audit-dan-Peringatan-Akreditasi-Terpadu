<?php

namespace App\Http\Requests\Prodi;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVmtsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visi'            => ['required', 'string'],
            'misi'            => ['required', 'string'],
            'tujuan'          => ['required', 'string'],
            'sasaran'         => ['required', 'string'],
            'file'            => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'tgl_penetapan'   => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'visi.required'          => 'Visi wajib diisi.',
            'misi.required'          => 'Misi wajib diisi.',
            'tujuan.required'        => 'Tujuan wajib diisi.',
            'sasaran.required'       => 'Sasaran wajib diisi.',
            'file.file'              => 'File yang diunggah tidak valid.',
            'file.mimes'             => 'File harus berupa PDF, JPG, JPEG, atau PNG.',
            'file.max'               => 'Ukuran file maksimal 5 MB.',
            'tgl_penetapan.required' => 'Tanggal penetapan wajib diisi.',
            'tgl_penetapan.date'     => 'Tanggal penetapan tidak valid.',
        ];
    }
}