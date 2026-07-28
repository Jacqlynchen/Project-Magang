class UserCrud {
    constructor() {
        this.routes = window.routes;

        this.modal = new bootstrap.Modal(
            document.getElementById('userModal')
        );

        this.loadRoles();
        this.table = this.loadTable();
        this.events();
    }

    csrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            .content;
    }

    loadTable() {
        return $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: this.routes.datatable,

            columns: [
                {
                    title: 'No',
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    title: 'Nama',
                    data: 'name'
                },
                {
                    title: 'Email',
                    data: 'email'
                },
                {
                    title: 'Role',
                    data: 'role_name'
                },
                {
                    title: 'Aksi',
                    data: 'action',
                    searchable: false,
                    orderable: false
                }
            ]
        });
    }

    events() {
        $('#btnCreate').on('click', () => {
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#modalTitle').text('Tambah User');

            this.modal.show();
        });

        $(document).on('click', '.edit-btn', e => {
            this.edit($(e.currentTarget).data('id'));
        });

        $(document).on('click', '.delete-btn', e => {
            this.delete($(e.currentTarget).data('id'));
        });

        $('#userForm').on('submit', e => {
            e.preventDefault();

            $('#userId').val()
                ? this.update()
                : this.store();
        });
    }

    async loadRoles() {
        const response = await fetch('/roles-data', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (!response.ok) return;
        $('#role_id').empty();

        result.data.forEach(role => {
            $('#role_id').append(
                `<option value="${role.id}">${role.name}</option>`
            );

        });
    }

    async store() {
        const response = await fetch(this.routes.store, {
            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': this.csrfToken(),
                'Accept': 'application/json'
            },

            body: new FormData(document.getElementById('userForm'))
        });

        const result = await response.json();
        if (!response.ok) {
            alert(result.message);
            return;
        }

        alert(result.message);

        this.afterSubmit();
    }

    async edit(id) {
        const response = await fetch(`${this.routes.index}/${id}`);
        const result = await response.json();
        if (!response.ok) {
            alert('Data gagal diambil.');
            return;
        }
        const user = result.data;

        $('#userId').val(user.id);
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#role_id').val(user.role_id);
        $('#password').val('');
        $('#modalTitle').text('Edit User');

        this.modal.show();
    }

    async update() {
        const id = $('#userId').val();

        const formData = new FormData(document.getElementById('userForm'));
        formData.append('_method', 'PUT');

        const response = await fetch(`${this.routes.index}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken(),
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();

        if (!response.ok) {
            alert(result.message);
            return;
        }

        alert(result.message);
        this.afterSubmit();
    }

    async delete(id) {
        if (!confirm('Yakin ingin menghapus user ini?')) {
            return;
        }

        const response = await fetch(`${this.routes.index}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken(),
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (!response.ok) {
            alert(result.message);
            return;
        }
   
        alert(result.message);
        this.table.ajax.reload();
    }

    afterSubmit() {
        this.modal.hide();
        $('#userForm')[0].reset();
        $('#userId').val('');
        this.table.ajax.reload();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new UserCrud();
});