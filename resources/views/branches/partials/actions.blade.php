<div class="action-buttons">

    <a
        href="{{ route('branches.edit', $branch) }}"
        class="btn btn-warning"
    >
        Edit
    </a>

    <form
        action="{{ route('branches.destroy', $branch) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this branch?')"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger"
        >
            Delete
        </button>

    </form>

</div>