class RoleCrud {
    constructor() {
        this.routes = window.routes;

        this.modal = new bootstrap.Modal(
            document.getElementById('roleModal')
        );

        this.table = this.loadTable();

        this.events();
    }

    csrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            .content;
    }

    loadTable() {
        return $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: this.routes.datatable,

            columns: [
                {
                    title: 'No',
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },

                {
                    title: 'Nama Role',
                    data: 'name',
                    name: 'name'
                },

                {
                    title: 'Aksi',
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                }
            ]
        });
    }

    events() {
        $('#btnCreate').on('click', () => {
            $('#roleForm')[0].reset();
            $('#roleId').val('');
            $('#modalTitle').text('Tambah Role');
            this.modal.show();
        });

        $(document).on('click', '.edit-btn', (e) => {
            this.edit($(e.currentTarget).data('id'));
        });

        $(document).on('click', '.delete-btn', (e) => {
            this.delete($(e.currentTarget).data('id'));
        });

        $('#roleForm').on('submit', (e) => {
            e.preventDefault();

            if ($('#roleId').val()) {
                this.update();
            } else {
                this.store();
            }
        });
    }

    async store() {
        const response = await fetch(this.routes.store, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken(),
                'Accept': 'application/json'
            },
            body: new FormData(roleForm)
        });

        const result = await response.json();
        alert(result.message);
        this.modal.hide();
        this.table.ajax.reload();
    }
    
    async edit(id) {
        const response = await fetch(`${this.routes.index}/${id}`);
        const result = await response.json();
        $('#roleId').val(result.data.id);
        $('#name').val(result.data.name);
        $('#modalTitle').text('Edit Role');
        this.modal.show();
    }

    async update() {
        const formData = new FormData(roleForm);
        formData.append('_method', 'PUT');
        const id = $('#roleId').val();
        const response = await fetch(`${this.routes.index}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken(),
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();
        alert(result.message);
        this.modal.hide();
        this.table.ajax.reload();
    }

    async delete(id) {
        if (!confirm('Hapus role ini?')) {
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
        alert(result.message);
        this.table.ajax.reload();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    console.log(window.routes);
    new RoleCrud({
        routes: window.routes
        
    });
});