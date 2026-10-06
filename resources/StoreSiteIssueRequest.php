<?php

namespace App\Http\Requests;

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
}