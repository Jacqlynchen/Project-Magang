@extends('layouts.app')

@section('title', 'Branches')

@section('content')

<div class="branch-page">

    {{-- HEADER --}}
    <div class="branch-page-header">

        <div>
            <h1>Branches</h1>
            <p>Manage company branch locations.</p>
        </div>

        <a href="{{ route('branches.create') }}"
           class="branch-add-button">
            <span>+</span>
            Add Branch
        </a>

    </div>


    {{-- CARD --}}
    <div class="branch-card">

        <div class="branch-card-header">

            <h2>Branch List</h2>
            <p>List of all available branches.</p>

        </div>


        {{-- SEARCH / FILTER --}}
        <form
            action="{{ route('branches.index') }}"
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
                    placeholder="Search code, branch name, area..."
                >

            </div>


            <div class="branch-filter-group">

                <label for="area">
                    Area
                </label>

                <select id="area" name="area" class="branch-select">

                    <option value="">
                        All Area
                    </option>

                    @foreach($areas as $area)

                        <option
                            value="{{ $area }}"
                            {{ request('area') == $area ? 'selected' : '' }}
                        >
                            {{ $area }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="branch-filter-actions">

                <button type="submit" class="branch-search-button">
                    Search
                </button>

                <a href="{{ route('branches.index') }}" class="branch-reset-button">
                    Reset
                </a>

            </div>

        </form>


        {{-- TABLE --}}
        <div class="branch-table-wrapper">

            <table class="branch-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Branch Name</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Est. Run</th>
                        <th class="branch-action-column">Action</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($branches as $branch)

                        @php
                            $status = $branch->currentStatusLog->status ?? null;
                        @endphp

                        <tr>

                            <td>
                                {{ $loop->iteration + ($branches->currentPage() - 1) * $branches->perPage() }}
                            </td>


                            <td>
                                <span class="branch-code">
                                    {{ $branch->code ?? '-' }}
                                </span>
                            </td>


                            <td>
                                <div class="branch-name">
                                    {{ $branch->name }}
                                </div>

                                @if($branch->address && $branch->address->addr_1)
                                    <div class="table-secondary-text">
                                        {{ $branch->address->addr_1 }}
                                    </div>
                                @endif
                            </td>


                            <td>
                                {{ $branch->area ?? '-' }}
                            </td>


                            <td>
                                <span class="status-badge status-{{ $status->code ?? 'none' }}">
                                    {{ $status->name ?? 'No status' }}
                                </span>
                            </td>


                            <td>
                                {{ $branch->est_run_at
                                    ? $branch->est_run_at->format('d M Y')
                                    : '-'
                                }}
                            </td>


                            <td class="branch-actions">

                                <a href="{{ route('branches.edit', $branch) }}"
                                   class="branch-edit-button">
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('branches.destroy', $branch) }}"
                                    class="branch-delete-form"
                                    onsubmit="return confirm('Are you sure you want to delete this branch?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="branch-delete-button">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="branch-empty">
                                @if(request('search') || request('area'))
                                    No branches match your search.
                                @else
                                    No branches found.
                                @endif
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        {{ $branches->links('partials.pagination') }}

    </div>

</div>

@endsection