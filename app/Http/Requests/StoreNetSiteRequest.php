<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetSiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'addr_1' => ['nullable', 'string', 'max:255'],
            'addr_2' => ['nullable', 'string', 'max:255'],
            'addr_3' => ['nullable', 'string', 'max:255'],

            'lat' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'long' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'sid' => [
                'nullable',
                'string',
                'max:255',
            ],

            'ip_segment' => [
                'nullable',
                'string',
                'max:255',
            ],

            'speed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'pri_vendor_id' => [
                'nullable',
                'exists:vendors,id',
            ],

            'sec_vendor_id' => [
                'nullable',
                'exists:vendors,id',
            ],

            'status_id' => ['nullable', 'exists:statuses,id'],
            'status_remark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Net Site Name wajib diisi.',

            'lat.numeric' => 'Latitude harus berupa angka.',
            'long.numeric' => 'Longitude harus berupa angka.',
            'speed.numeric' => 'Speed harus berupa angka.',

            'branch_id.required' => 'Branch wajib dipilih.',
            'branch_id.exists' => 'Branch tidak ditemukan.',

            'pri_vendor_id.exists' => 'Primary Vendor tidak ditemukan.',
            'sec_vendor_id.exists' => 'Secondary Vendor tidak ditemukan.',

            'amount.numeric' => 'Amount harus berupa angka.',
            'status_id.exists' => 'Status tidak ditemukan.',
        ];
    }
}