@extends('layouts.app')

@section('content')

<h3>Tambah User</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email') }}">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input
            type="password"
            name="password"
            class="form-control">
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection