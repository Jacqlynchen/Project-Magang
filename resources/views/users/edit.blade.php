@extends('layouts.app')

@section('content')

<h3>Edit User</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update', $user) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $user->name) }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email', $user->email) }}">
    </div>

    <div class="mb-3">
        <label>Password Baru</label>
        <input
            type="password"
            name="password"
            class="form-control">

        <small class="text-muted">
            Kosongkan jika tidak ingin mengubah password.
        </small>
    </div>

    <button class="btn btn-primary">
        Update
    </button>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection