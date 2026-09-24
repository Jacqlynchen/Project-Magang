@extends('layouts.app')

@section('title', 'Net Sites')

@section('content')

<div class="page-container">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Net Sites</h1>

            <p>
                Manage network site information.
            </p>
        </div>

        <a
            href="{{ route('net-sites.create') }}"
            class="btn btn-primary"
        >
            + Add Net Site
        </a>

    </div>


    {{-- TABLE CARD --}}
    <div class="content-card">

        <div class="content-card-header">

            <div>
                <h2>Net Site List</h2>

                <p>
                    List of registered network sites.
                </p>
            </div>

        </div>


        <div class="table-wrapper">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Net Site</th>
                        <th>Branch</th>
                        <th>SID</th>
                        <th>IP Segment</th>
                        <th>Speed</th>
                        <th>Status</th>
                        <th>Primary Vendor</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($netSites as $netSite)

                        @php
                            $status = $netSite->currentStatusLog->status ?? null;
                        @endphp

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration + ($netSites->currentPage() - 1) * $netSites->perPage() }}
                            </td>


                            {{-- NET SITE --}}
                            <td>

                                <div class="table-primary-text">
                                    {{ $netSite->name }}
                                </div>

                                @if($netSite->addr_1)
                                    <div class="table-secondary-text">
                                        {{ $netSite->addr_1 }}
                                    </div>
                                @endif

                            </td>


                            {{-- BRANCH --}}
                            <td>
                                {{ $netSite->branch->name ?? '-' }}
                            </td>


                            {{-- SID --}}
                            <td>
                                {{ $netSite->sid ?? '-' }}
                            </td>


                            {{-- IP SEGMENT --}}
                            <td>
                                {{ $netSite->ip_segment ?? '-' }}
                            </td>


                            {{-- SPEED --}}
                            <td>
                                {{ $netSite->speed !== null ? $netSite->speed.' Mbps' : '-' }}
                            </td>


                            {{-- STATUS --}}
                            <td>
                                <span class="status-badge status-{{ $status->code ?? 'none' }}">
                                    {{ $status->name ?? 'No status' }}
                                </span>
                            </td>


                            {{-- PRIMARY VENDOR --}}
                            <td>
                                {{ $netSite->primaryVendor->name ?? '-' }}
                            </td>


                            {{-- ACTION --}}
                            <td class="text-right">

                                <div class="table-actions">

                                    <a
                                        href="{{ route('net-sites.edit', $netSite) }}"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('net-sites.destroy', $netSite) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Net Site ini?')"
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
                                colspan="9"
                                class="empty-table"
                            >

                                <div class="empty-table-icon">
                                    ▦
                                </div>

                                <div class="empty-table-title">
                                    Belum ada data Net Site
                                </div>

                                <div class="empty-table-text">
                                    Tambahkan Net Site untuk mulai mengelola data jaringan.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        {{ $netSites->links('partials.pagination') }}

    </div>

</div>

@endsection