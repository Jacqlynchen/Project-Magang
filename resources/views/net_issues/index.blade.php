@extends('layouts.app')

@section('title', 'Net Issues')

@section('content')

<div class="page-container">

    <div class="page-header">

        <div>
            <h1>Net Issues</h1>
            <p>Master list of network issue types.</p>
        </div>

        <a href="{{ route('net-issues.create') }}" class="btn btn-primary">
            + Add Issue Type
        </a>

    </div>


    <div class="content-card">

        <div class="content-card-header">
            <div>
                <h2>Issue Type List</h2>
                <p>Used when creating a Site Issue report.</p>
            </div>
        </div>


        <form action="{{ route('net-issues.index') }}" method="GET" class="branch-filter">

            <div class="branch-filter-group branch-filter-grow">
                <label for="search">Search</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    class="branch-input"
                    placeholder="Search issue name or description..."
                >
            </div>

            <div class="branch-filter-actions">
                <button type="submit" class="branch-search-button">Search</button>
                <a href="{{ route('net-issues.index') }}" class="branch-reset-button">Reset</a>
            </div>

        </form>


        <div class="table-wrapper">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Issue Name</th>
                        <th>Description</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($netIssues as $netIssue)

                        <tr>
                            <td>
                                {{ $loop->iteration + ($netIssues->currentPage() - 1) * $netIssues->perPage() }}
                            </td>

                            <td>
                                <div class="table-primary-text">{{ $netIssue->name }}</div>
                            </td>

                            <td>{{ $netIssue->description ?? '-' }}</td>

                            <td class="text-right">
                                <div class="table-actions">

                                    <a href="{{ route('net-issues.edit', $netIssue) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('net-issues.destroy', $netIssue) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus issue type ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Delete</button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="empty-table">
                                <div class="empty-table-icon">◇</div>
                                <div class="empty-table-title">Belum ada Issue Type</div>
                                <div class="empty-table-text">Tambahkan tipe issue untuk dipakai di laporan Site Issue.</div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{ $netIssues->links('partials.pagination') }}

    </div>

</div>

@endsection