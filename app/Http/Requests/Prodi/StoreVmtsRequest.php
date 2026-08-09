<?php

namespace App\Http\Requests\Prodi;

use Illuminate\Foundation\Http\FormRequest;

class StoreVmtsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visi'     => ['required', 'string'],
            'misi'     => ['required', 'string'],
            'tujuan'   => ['required', 'string'],
            'sasaran'  => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'visi.required'     => 'Visi wajib diisi.',
            'misi.required'     => 'Misi wajib diisi.',
            'tujuan.required'   => 'Tujuan wajib diisi.',
            'sasaran.required'  => 'Sasaran wajib diisi.',
        ];
    }
}