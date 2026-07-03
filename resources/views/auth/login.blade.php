@extends('layouts.app')

@section('content')

<h3>Login</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        Email atau password salah.
    </div>
@endif

<form action="{{ route('login.process') }}" method="POST">
    @csrf

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

    <button class="btn btn-primary">
        Login
    </button>
</form>

@endsection