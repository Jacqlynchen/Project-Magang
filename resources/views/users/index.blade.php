@extends('layouts.app')

@section('content')

{{-- Tombol Tambah User hanya untuk Admin --}}
@can('create', App\Models\User::class)
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        Tambah User
    </a>
@endcan

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

                {{-- Tombol Edit hanya untuk Admin --}}
                @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>
                @endcan

                {{-- Tombol Hapus hanya untuk Admin --}}
                @can('delete', $user)
                    <form action="{{ route('users.destroy', $user) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </button>

                    </form>
                @endcan

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