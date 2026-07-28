@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Data Role</h3>

    @can('create', App\Models\Role::class)
        <button
            id="btnCreate"
            class="btn btn-primary">
            Tambah Role
        </button>
    @endcan

</div>

<table
    id="roles-table"
    class="table table-bordered table-striped"
    style="width:100%">
</table>

<div
    class="modal fade"
    id="roleModal"
    tabindex="-1">

    <div class="modal-dialog">

        <form id="roleForm">

            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="modalTitle">

                        Tambah Role

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        id="roleId">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Role
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control">

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
    datatable: "{{ route('datatables', ['table' => 'roles']) }}",
    index : "{{ route('roles.index') }}",
    store : "{{ route('roles.store') }}"
};

</script>

<script src="{{ asset('js/roles.js') }}"></script>

@endpush