@extends('layouts.app')

@section('title', 'Vendors')

@section('content')

<div class="page-container">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Vendors</h1>

            <p>
                Manage network vendor information.
            </p>
        </div>

        <a
            href="{{ route('vendors.create') }}"
            class="btn btn-primary"
        >
            + Add Vendor
        </a>

    </div>


    {{-- CARD --}}
    <div class="content-card">

        <div class="content-card-header">

            <div>
                <h2>Vendor List</h2>

                <p>
                    List of registered vendors.
                </p>
            </div>

        </div>


        {{-- SEARCH --}}
        <form
            action="{{ route('vendors.index') }}"
            method="GET"
            class="branch-filter"
        >

            <div class="branch-filter-group branch-filter-grow">

                <label for="search">
                    Search
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    class="branch-input"
                    placeholder="Search vendor name or email..."
                >

            </div>


            <div class="branch-filter-actions">

                <button type="submit" class="branch-search-button">
                    Search
                </button>

                <a href="{{ route('vendors.index') }}" class="branch-reset-button">
                    Reset
                </a>

            </div>

        </form>


        {{-- TABLE --}}
        <div class="table-wrapper">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Vendor Name</th>
                        <th>Email</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($vendors as $vendor)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($vendors->currentPage() - 1) * $vendors->perPage() }}
                            </td>

                            <td>
                                <div class="table-primary-text">
                                    {{ $vendor->name }}
                                </div>
                            </td>

                            <td>
                                {{ $vendor->email ?? '-' }}
                            </td>

                            <td class="text-right">

                                <div class="table-actions">

                                    <a
                                        href="{{ route('vendors.edit', $vendor) }}"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('vendors.destroy', $vendor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Vendor ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="empty-table"
                            >

                                <div class="empty-table-icon">
                                    ◇
                                </div>

                                <div class="empty-table-title">
                                    @if(request('search'))
                                        Tidak ada vendor yang cocok
                                    @else
                                        Belum ada data Vendor
                                    @endif
                                </div>

                                <div class="empty-table-text">
                                    Tambahkan Vendor untuk mulai mengelola data jaringan.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        {{ $vendors->links('partials.pagination') }}

    </div>

</div>

@endsection