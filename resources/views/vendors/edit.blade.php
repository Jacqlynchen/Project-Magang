@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')

<div class="page-container">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Edit Vendor</h1>

            <p>
                Update vendor information.
            </p>
        </div>

        <a
            href="{{ route('vendors.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

    </div>


    {{-- FORM CARD --}}
    <div class="form-card">

        <form
            action="{{ route('vendors.update', $vendor) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- VENDOR NAME --}}
                <div class="form-group">

                    <label for="name">
                        Vendor Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $vendor->name) }}"
                        class="form-input"
                        placeholder="Enter vendor name"
                        required
                    >

                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $vendor->email) }}"
                        class="form-input"
                        placeholder="vendor@example.com"
                    >

                    @error('email')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>


            {{-- FORM FOOTER --}}
            <div class="form-footer">

                <a
                    href="{{ route('vendors.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Vendor
                </button>

            </div>

        </form>

    </div>

</div>

@endsection