<?php

namespace App\Http\Requests\Fakultas;

use Illuminate\Foundation\Http\FormRequest;

class StoreVmtsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'visi'          => ['nullable', 'string'],
            'misi'          => ['nullable', 'string'],
            'tujuan'        => ['nullable', 'string'],
            'sasaran'       => ['nullable', 'string'],
            'file'          => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'tgl_penetapan' => ['nullable', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'file.file'    => 'File yang diunggah harus berupa file.',
            'file.mimes'   => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            'file.max'     => 'Ukuran file maksimal 5 MB.',
            'tgl_penetapan.date' => 'Tanggal penetapan harus berupa tanggal yang valid.',
        ];
    }
}