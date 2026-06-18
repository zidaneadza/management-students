<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nim' => ['required', 'regex:/^\d{8,10}$/'],
            'nama' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'jurusan' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'ipk' => ['required', 'numeric', 'between:0,4'],
            'email' => ['required', 'email'],
            'no_hp' => ['required', 'regex:/^\+?\d{10,15}$/'],
        ];
    }
}
