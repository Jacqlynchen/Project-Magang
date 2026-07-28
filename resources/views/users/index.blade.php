@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    
    <h3>Data User</h3>

    @can('create', App\Models\User::class)
        <button
            id="btnCreate" class="btn btn-primary">
            Tambah User
        </button>
    @endcan

</div>

<table
    id="users-table"
    class="table table-bordered table-striped"
    style="width:100%">
</table>

<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="userForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        Tambah User
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="userId" name="userId">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Role</label>

                        <select
                            id="role_id"
                            name="role_id"
                            class="form-select">

                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')

<link rel="stylesheet"
href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
window.routes = {
    datatable: "{{ route('datatables', ['table' => 'users']) }}",
    index: "{{ route('users.index') }}",
    store: "{{ route('users.store') }}"
};
</script>

<script src="{{ asset('js/users.js') }}"></script>

@endpush