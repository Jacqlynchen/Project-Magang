@extends('layouts.app')

@section('title', 'Edit Issue Type')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Edit Issue Type</h1>
            <p>Update this issue type.</p>
        </div>

        <a href="{{ route('net-issues.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>


    <div class="form-card">

        <form action="{{ route('net-issues.update', $netIssue) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="name">Issue Name <span>*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $netIssue->name) }}"
                        class="form-input"
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
                        value="{{ old('description', $netIssue->description) }}"
                        class="form-input"
                    >
                    @error('description')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-footer">
                <a href="{{ route('net-issues.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Issue Type</button>
            </div>

        </form>

    </div>

</div>

@endsection