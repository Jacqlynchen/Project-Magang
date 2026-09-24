@extends('layouts.app')

@section('title', 'Add Branch')

@section('content')

<div class="branch-page">

    {{-- HEADER --}}
    <div class="branch-page-header">

        <div>
            <h1>Add Branch</h1>
            <p>Create a new branch location.</p>
        </div>

        <a href="{{ route('branches.index') }}"
           class="btn btn-secondary">
            ← Back
        </a>

    </div>


    {{-- FORM CARD --}}
    <div class="branch-card">

        <div class="branch-card-header">

            <h2>Branch Information</h2>
            <p>Enter the information for the new branch.</p>

        </div>


        <form action="{{ route('branches.store') }}" method="POST">

            @csrf


            <div class="form-grid">

                {{-- CODE --}}
                <div class="form-group">

                    <label for="code">
                        Branch Code
                    </label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="{{ old('code') }}"
                        placeholder="Example: 001"
                    >

                    @error('code')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- NAME --}}
                <div class="form-group">

                    <label for="name">
                        Branch Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Example: Surabaya"
                        required
                    >

                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- AREA --}}
                <div class="form-group">

                    <label for="area">
                        Area <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="area"
                        name="area"
                        value="{{ old('area') }}"
                        placeholder="Example: Jawa Timur"
                        required
                    >

                    @error('area')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- DATE --}}
                <div class="form-group">

                    <label for="est_run_at">
                        Estimated Run Date
                    </label>

                    <input
                        type="date"
                        id="est_run_at"
                        name="est_run_at"
                        value="{{ old('est_run_at') }}"
                    >

                    @error('est_run_at')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            {{-- STATUS SECTION --}}
            <div class="branch-card-header" style="border-top: 1px solid var(--border);">
                <h2>Status</h2>
                <p>Optional — set the branch's current operational status.</p>
            </div>

            <div class="form-grid">

                {{-- STATUS --}}
                <div class="form-group">

                    <label for="status_id">
                        Status
                    </label>

                    <select id="status_id" name="status_id">

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
                        <span class="form-error">{{ $message }}</span>
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
                        placeholder="Optional note about this status"
                    >

                    @error('status_remark')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            {{-- ADDRESS SECTION --}}
            <div class="branch-card-header" style="border-top: 1px solid var(--border);">
                <h2>Address</h2>
                <p>Optional — location details for this branch.</p>
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
                        placeholder="Street name, building number"
                    >

                    @error('addr_1')
                        <span class="form-error">{{ $message }}</span>
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
                        placeholder="District / City"
                    >

                    @error('addr_2')
                        <span class="form-error">{{ $message }}</span>
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
                        placeholder="Province / Postal code"
                    >

                    @error('addr_3')
                        <span class="form-error">{{ $message }}</span>
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
                        placeholder="-7.250445"
                    >

                    @error('lat')
                        <span class="form-error">{{ $message }}</span>
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
                        placeholder="112.768845"
                    >

                    @error('long')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            {{-- BUTTONS --}}
            <div class="form-footer">

                <a href="{{ route('branches.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Save Branch
                </button>

            </div>

        </form>

    </div>

</div>

@endsection