@extends('layouts.app')

@section('title', 'Ubah Laporan Gangguan')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Edit Issue Report</h1>
            <p>Update this issue report.</p>
        </div>

        <a href="{{ route('site-issues.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>


    <div class="form-card">

        <form action="{{ route('site-issues.update', $siteIssue) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="net_site_id">Net Site <span>*</span></label>
                    <select id="net_site_id" name="net_site_id" class="form-input" required>
                        <option value="">Select Net Site</option>
                        @foreach($netSites as $netSite)
                            <option
                                value="{{ $netSite->id }}"
                                data-branch-code="{{ $netSite->branch->code ?? '' }}"
                                {{ old('net_site_id', $siteIssue->net_site_id) == $netSite->id ? 'selected' : '' }}
                            >
                                {{ $netSite->name }} @if($netSite->branch)({{ $netSite->branch->name }})@endif
                            </option>
                        @endforeach
                    </select>
                    @error('net_site_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="net_issue_id">Issue Type <span>*</span></label>
                    <select id="net_issue_id" name="net_issue_id" class="form-input" required>
                        <option value="">Select Issue Type</option>
                        @foreach($netIssues as $netIssue)
                            <option
                                value="{{ $netIssue->id }}"
                                {{ old('net_issue_id', $siteIssue->net_issue_id) == $netIssue->id ? 'selected' : '' }}
                            >
                                {{ $netIssue->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('net_issue_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="employee_id">Reported By</label>
                    <select id="employee_id" name="employee_id" class="form-input">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option
                                value="{{ $employee->id }}"
                                data-branch-code="{{ $employee->branch_code }}"
                                {{ old('employee_id', $siteIssue->employee_id) == $employee->id ? 'selected' : '' }}
                            >
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                    <small>
                        Changing the Net Site will re-filter the list of employees based on their branch.
                    </small>
                    @error('employee_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="remark">Note</label>
                    <input
                        type="text"
                        id="remark"
                        name="remark"
                        value="{{ old('remark', $siteIssue->remark) }}"
                        class="form-input"
                        placeholder="Optional note — can be left blank"
                    >
                    @error('remark')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="content-card-header" style="border-top: 1px solid var(--border);">
                <div>
                    <h2>Status</h2>
                    <p>
                        Currently:
                        <strong>{{ $siteIssue->currentStatusLog->status->name ?? 'No status available' }}</strong>
                        — changing the status will create a new status history.
                    </p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select id="status_id" name="status_id" class="form-input">
                        <option value="">Not Changed</option>
                        @foreach($statuses as $status)
                            <option
                                value="{{ $status->id }}"
                                {{ old('status_id', $siteIssue->currentStatusLog->status_id ?? '') == $status->id ? 'selected' : '' }}
                            >
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_remark">Status Note</label>
                    <input
                        type="text"
                        id="status_remark"
                        name="status_remark"
                        value="{{ old('status_remark') }}"
                        class="form-input"
                        placeholder="Optional note about this status change"
                    >
                    @error('status_remark')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-footer">
                <a href="{{ route('site-issues.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Report</button>
            </div>

        </form>

    </div>

</div>


<script>
    (function () {
        var netSiteSelect = document.getElementById('net_site_id');
        var employeeSelect = document.getElementById('employee_id');
        if (!netSiteSelect || !employeeSelect) return;

        function filterEmployees() {
            var option = netSiteSelect.options[netSiteSelect.selectedIndex];
            var branchCode = option ? option.getAttribute('data-branch-code') : '';

            Array.prototype.forEach.call(employeeSelect.options, function (opt) {
                if (!opt.value) {
                    opt.style.display = '';
                    return;
                }
                var match = !branchCode || opt.getAttribute('data-branch-code') === branchCode;
                opt.style.display = match ? '' : 'none';
            });
        }

        // Hanya jalan saat user GANTI Net Site secara aktif — supaya
        // karyawan yang sudah tersimpan tidak hilang begitu halaman dibuka.
        netSiteSelect.addEventListener('change', function () {
            filterEmployees();
            employeeSelect.value = '';
        });
    })();
</script>

@endsection