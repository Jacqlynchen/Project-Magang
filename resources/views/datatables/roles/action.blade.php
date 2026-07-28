@can('update', $role)
<button class="btn btn-warning btn-sm edit-btn" data-id="{{ $role->id }}">
    Edit
</button>
@endcan

@can('delete', $role)
<button class="btn btn-danger btn-sm delete-btn ms-1" data-id="{{ $role->id }}">
    Hapus
</button>
@endcan