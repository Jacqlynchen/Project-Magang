@extends('layouts.app')

@section('content')

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
    Tambah User
</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>
    
    <tbody>

    @forelse($users as $user)

        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                <a href="{{ route('users.edit',$user) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form
                    action="{{ route('users.destroy',$user) }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>

    @empty
        <tr>
            <td colspan="4" class="text-center">
                Tidak ada data.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection