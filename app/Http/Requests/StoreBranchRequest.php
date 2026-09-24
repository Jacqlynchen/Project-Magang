<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('branches', 'code'),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'area' => [
                'required',
                'string',
                'max:255',
            ],

            'est_run_at' => [
                'nullable',
                'date',
            ],

            'addr_1' => ['nullable', 'string', 'max:255'],
            'addr_2' => ['nullable', 'string', 'max:255'],
            'addr_3' => ['nullable', 'string', 'max:255'],

            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'long' => ['nullable', 'numeric', 'between:-180,180'],

            'status_id' => ['nullable', 'exists:statuses,id'],
            'status_remark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'Branch Code sudah digunakan.',
            'name.required' => 'Branch Name wajib diisi.',
            'area.required' => 'Area wajib diisi.',
            'est_run_at.date' => 'Format tanggal tidak valid.',
            'lat.numeric' => 'Latitude harus berupa angka.',
            'long.numeric' => 'Longitude harus berupa angka.',
            'status_id.exists' => 'Status tidak ditemukan.',
        ];
    }
}