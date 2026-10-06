@extends('layouts.app')

@section('title', 'Add Net Site')

@section('content')

<div class="page-container">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Add Net Site</h1>

            <p>
                Add a new network site.
            </p>
        </div>

        <a
            href="{{ route('net-sites.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

    </div>


    {{-- FORM CARD --}}
    <div class="form-card">

        <form
            action="{{ route('net-sites.store') }}"
            method="POST"
            id="net-site-form"
        >

            @csrf

            <div class="form-grid">

                {{-- NET SITE NAME --}}
                <div class="form-group">

                    <label for="name">
                        Net Site Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-input"
                        placeholder="Enter net site name"
                        required
                    >

                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BRANCH --}}
                <div class="form-group">

                    <label for="branch_id">
                        Branch <span>*</span>
                    </label>

                    <select
                        id="branch_id"
                        name="branch_id"
                        class="form-input"
                        required
                    >

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                data-addr1="{{ $branch->address->addr_1 ?? '' }}"
                                data-addr2="{{ $branch->address->addr_2 ?? '' }}"
                                data-addr3="{{ $branch->address->addr_3 ?? '' }}"
                                data-lat="{{ $branch->address->lat ?? '' }}"
                                data-long="{{ $branch->address->long ?? '' }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                            >
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                    <small>
                        Selecting a branch will fill the address below from that branch — you can still edit it.
                    </small>

                    @error('branch_id')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- SID --}}
                <div class="form-group">

                    <label for="sid">
                        SID
                    </label>

                    <input
                        type="text"
                        id="sid"
                        name="sid"
                        value="{{ old('sid') }}"
                        class="form-input"
                        placeholder="Enter SID"
                    >

                </div>


                {{-- IP SEGMENT --}}
                <div class="form-group">

                    <label for="ip_segment">
                        IP Segment
                    </label>

                    <input
                        type="text"
                        id="ip_segment"
                        name="ip_segment"
                        value="{{ old('ip_segment') }}"
                        class="form-input"
                        placeholder="192.168.1.0/24"
                    >

                </div>


                {{-- SPEED --}}
                <div class="form-group">

                    <label for="speed">
                        Speed (Mbps)
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="speed"
                        name="speed"
                        value="{{ old('speed') }}"
                        class="form-input"
                        placeholder="100"
                    >

                    @error('speed')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- AMOUNT --}}
                <div class="form-group">

                    <label for="amount">
                        Amount
                    </label>

                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        value="{{ old('amount', 0) }}"
                        class="form-input"
                        placeholder="0"
                    >

                </div>


                {{-- PRIMARY VENDOR --}}
                <div class="form-group">

                    <label for="pri_vendor_id">
                        Primary Vendor
                    </label>

                    <select
                        id="pri_vendor_id"
                        name="pri_vendor_id"
                        class="form-input"
                    >

                        <option value="">
                            Select Primary Vendor
                        </option>

                        @foreach($vendors as $vendor)

                            <option
                                value="{{ $vendor->id }}"
                                {{ old('pri_vendor_id') == $vendor->id ? 'selected' : '' }}
                            >
                                {{ $vendor->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- SECONDARY VENDOR --}}
                <div class="form-group">

                    <label for="sec_vendor_id">
                        Secondary Vendor
                    </label>

                    <select
                        id="sec_vendor_id"
                        name="sec_vendor_id"
                        class="form-input"
                    >

                        <option value="">
                            Select Secondary Vendor
                        </option>

                        @foreach($vendors as $vendor)

                            <option
                                value="{{ $vendor->id }}"
                                {{ old('sec_vendor_id') == $vendor->id ? 'selected' : '' }}
                            >
                                {{ $vendor->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- STATUS SECTION --}}
            <div class="content-card-header" style="border-top: 1px solid var(--border);">
                <div>
                    <h2>Status</h2>
                    <p>Optional — set this net site's current operational status.</p>
                </div>
            </div>

            <div class="form-grid">

                {{-- STATUS --}}
                <div class="form-group">

                    <label for="status_id">
                        Status
                    </label>

                    <select id="status_id" name="status_id" class="form-input">

                        <option value="">
                            No status
                        </option>

                        @foreach($statuses as $status)

                            <option
                                value="{{ $status->id }}"
                                {{ old('status_id') == $status->id ? 'selected' : '' }}
                            >
                                {{ $status->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('status_id')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STATUS REMARK --}}
                <div class="form-group">

                    <label for="status_remark">
                        Remark
                    </label>

                    <input
                        type="text"
                        id="status_remark"
                        name="status_remark"
                        value="{{ old('status_remark') }}"
                        class="form-input"
                        placeholder="Optional note about this status"
                    >

                    @error('status_remark')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>


            {{-- ADDRESS SECTION --}}
            <div class="content-card-header" style="border-top: 1px solid var(--border);">
                <div>
                    <h2>Address</h2>
                    <p>Optional — auto-filled from the selected branch, editable.</p>
                </div>
            </div>

            <div class="form-grid">

                {{-- ADDRESS LINE 1 --}}
                <div class="form-group">

                    <label for="addr_1">
                        Address Line 1
                    </label>

                    <input
                        type="text"
                        id="addr_1"
                        name="addr_1"
                        value="{{ old('addr_1') }}"
                        class="form-input"
                        placeholder="Street name, building number"
                    >

                    @error('addr_1')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ADDRESS LINE 2 --}}
                <div class="form-group">

                    <label for="addr_2">
                        Address Line 2
                    </label>

                    <input
                        type="text"
                        id="addr_2"
                        name="addr_2"
                        value="{{ old('addr_2') }}"
                        class="form-input"
                        placeholder="District / City"
                    >

                    @error('addr_2')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ADDRESS LINE 3 --}}
                <div class="form-group">

                    <label for="addr_3">
                        Address Line 3
                    </label>

                    <input
                        type="text"
                        id="addr_3"
                        name="addr_3"
                        value="{{ old('addr_3') }}"
                        class="form-input"
                        placeholder="Province / Postal code"
                    >

                    @error('addr_3')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- LATITUDE --}}
                <div class="form-group">

                    <label for="lat">
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="lat"
                        name="lat"
                        value="{{ old('lat') }}"
                        class="form-input"
                        placeholder="-7.250445"
                    >

                    @error('lat')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- LONGITUDE --}}
                <div class="form-group">

                    <label for="long">
                        Longitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="long"
                        name="long"
                        value="{{ old('long') }}"
                        class="form-input"
                        placeholder="112.768845"
                    >

                    @error('long')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>


            {{-- FORM FOOTER --}}
            <div class="form-footer">

                <a
                    href="{{ route('net-sites.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Net Site
                </button>

            </div>

        </form>

    </div>

</div>


<script>
    (function () {
        var branchSelect = document.getElementById('branch_id');
        if (!branchSelect) return;

        branchSelect.addEventListener('change', function () {
            var option = branchSelect.options[branchSelect.selectedIndex];
            if (!option) return;

            document.getElementById('addr_1').value = option.getAttribute('data-addr1') || '';
            document.getElementById('addr_2').value = option.getAttribute('data-addr2') || '';
            document.getElementById('addr_3').value = option.getAttribute('data-addr3') || '';
            document.getElementById('lat').value = option.getAttribute('data-lat') || '';
            document.getElementById('long').value = option.getAttribute('data-long') || '';
        });
    })();
</script>

@endsection