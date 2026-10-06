@extends('layouts.app')

@section('title', 'Add Issue Type')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Add Issue Type</h1>
            <p>Add a new network issue type.</p>
        </div>

        <a href="{{ route('net-issues.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>


    <div class="form-card">

        <form action="{{ route('net-issues.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label for="name">Issue Name <span>*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-input"
                        placeholder="Example: Fiber Cut"
                        required
                    >
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input
                        type="text"
                        id="description"
                        name="description"
                        value="{{ old('description') }}"
                        class="form-input"
                        placeholder="Short description of this issue type"
                    >
                    @error('description')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-footer">
                <a href="{{ route('net-issues.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Issue Type</button>
            </div>

        </form>

    </div>

</div>

@endsection