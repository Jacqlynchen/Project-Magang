@extends('layouts.app')

@section('title', 'Karyawan')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Employees</h1>
            <p>Employee data (view-only — sourced from the HR system through a seeder).</p>
        </div>
    </div>


    <div class="content-card">

        <div class="content-card-header">
            <div>
                <h2>Employee List</h2>
                <p>This list is populated by the EmployeeSeeder and cannot be modified from here.</p>
            </div>
        </div>


        <form action="{{ route('employees.index') }}" method="GET" class="branch-filter">

            <div class="branch-filter-group branch-filter-grow">
                <label for="search">Search</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    class="branch-input"
                    placeholder="Search by name, NIK, or branch code..."
                >
            </div>

            <div class="branch-filter-actions">
                <button type="submit" class="branch-search-button">Search</button>
                <a href="{{ route('employees.index') }}" class="branch-reset-button">Reset</a>
            </div>

        </form>


        <div class="table-wrapper">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Position</th>
                        <th>Branch Code</th>
                        <th>Nama Cabang</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($employees as $employee)

                        <tr>
                            <td>
                                {{ $loop->iteration + ($employees->currentPage() - 1) * $employees->perPage() }}
                            </td>

                            <td>{{ $employee->nik }}</td>

                            <td>
                                <div class="table-primary-text">{{ $employee->name }}</div>
                            </td>

                            <td>{{ $employee->phone ?? '-' }}</td>

                            <td>{{ $employee->position_title ?? '-' }}</td>

                            <td>{{ $employee->branch_code ?? '-' }}</td>

                            <td>{{ $employee->branch->name ?? '-' }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty-table">
                                <div class="empty-table-icon">◇</div>
                                <div class="empty-table-title">No employee data available yet</div>
                                <div class="empty-table-text">
                                    Run <code>php artisan db:seed --class=EmployeeSeeder</code> to populate the data.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{ $employees->links('partials.pagination') }}

    </div>

</div>

@endsection