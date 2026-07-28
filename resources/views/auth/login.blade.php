@extends('layouts.app')

@section('content')

<h3>Login</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@error('email')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror

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