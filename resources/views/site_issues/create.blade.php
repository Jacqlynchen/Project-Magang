@extends('layouts.app')

@section('title', 'Buat Laporan Gangguan')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Report an Issue</h1>
            <p>New reports are automatically set to <strong>Pending</strong> status. After saving, a notification email will be sent to the main vendor of the net site.</p>
        </div>

        <a href="{{ route('site-issues.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>


    <div class="form-card">

        <form action="{{ route('site-issues.store') }}" method="POST" id="site-issue-form">

            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label for="net_site_id">Net Site <span>*</span></label>
                    <select id="net_site_id" name="net_site_id" class="form-input" required>
                        <option value="">Select Net Site</option>
                        @foreach($netSites as $netSite)
                            <option
                                value="{{ $netSite->id }}"
                                data-branch-code="{{ $netSite->branch->code ?? '' }}"
                                {{ old('net_site_id') == $netSite->id ? 'selected' : '' }}
                            >
                                {{ $netSite->name }} @if($netSite->branch)({{ $netSite->branch->name }})@endif
                            </option>
                        @endforeach
                    </select>

                    @if($netSites->isEmpty())
                        <small style="color: var(--danger);">
                            No active Net Sites with a main vendor and email address available.
                        </small>
                    @else
                        <small>
                            Only active Net Sites with a main vendor will appear here.
                        </small>
                    @endif

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
                                {{ old('net_issue_id') == $netIssue->id ? 'selected' : '' }}
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
                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                            >
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                    <small>
                        Select a Net Site first — the list of employees here will automatically follow the branch of the selected Net Site.
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
                        value="{{ old('remark') }}"
                        class="form-input"
                        placeholder="Optional note — can be left blank"
                    >
                    @error('remark')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-footer">
                <a href="{{ route('site-issues.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" {{ $netSites->isEmpty() ? 'disabled' : '' }}>
                    Save
                </button>
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

            var selected = employeeSelect.options[employeeSelect.selectedIndex];
            if (selected && selected.style.display === 'none') {
                employeeSelect.value = '';
            }
        }

        netSiteSelect.addEventListener('change', filterEmployees);

        // Jalankan sekali saat halaman dibuka, untuk kasus validasi gagal
        // lalu net_site_id sudah ke-reselect oleh old().
        filterEmployees();
    })();
</script>

@endsection