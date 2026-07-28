@can('update', $user)
<button
    class="btn btn-warning btn-sm edit-btn"
    data-id="{{ $user->id }}">
    Edit
</button>
@endcan

@can('delete', $user)
<button
    class="btn btn-danger btn-sm delete-btn ms-1"
    data-id="{{ $user->id }}">
    Hapus
</button>
@endcan