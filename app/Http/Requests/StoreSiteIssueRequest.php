<?php

namespace App\Http\Requests;

use App\Models\NetSite;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiteIssueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'net_site_id' => ['required', 'exists:net_sites,id'],
            'net_issue_id' => ['required', 'exists:net_issues,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],

            // Optional note — can be left empty.
            'remark' => ['nullable', 'string', 'max:255'],

            'status_id' => ['nullable', 'exists:statuses,id'],
            'status_remark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'net_site_id.required' => 'Net Site wajib dipilih.',
            'net_site_id.exists' => 'Net Site tidak ditemukan.',
            'net_issue_id.required' => 'Issue Type wajib dipilih.',
            'net_issue_id.exists' => 'Issue Type tidak ditemukan.',
            'employee_id.exists' => 'Employee tidak ditemukan.',
            'status_id.exists' => 'Status tidak ditemukan.',
        ];
    }

    /**
     * Pastikan Net Site yang dipilih benar-benar punya Vendor Utama
     * dengan email — kalau tidak, laporan tidak akan bisa dikirim ke
     * mana-mana. Ini jaring pengaman kalau dropdown "diakali" lewat
     * request manual, karena normalnya dropdown sudah difilter.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->filled('net_site_id')) {
                return;
            }

            $netSite = NetSite::with('primaryVendor')->find($this->net_site_id);

            if ($netSite && empty(optional($netSite->primaryVendor)->email)) {
                $validator->errors()->add(
                    'net_site_id',
                    'Net Site ini belum punya Vendor Utama dengan email. Tambahkan vendor dulu di halaman Net Site.'
                );
            }
        });
    }
}