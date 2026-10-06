@extends('layouts.app')

@section('title', 'Site Issues')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Site Issues</h1>
            <p>Reports of issues at network sites.</p>
        </div>

        <a href="{{ route('site-issues.create') }}" class="btn btn-primary">
            + Report Issue
        </a>
    </div>


    <div class="content-card">

        <div class="content-card-header">
            <div>
                <h2>Issue Report List</h2>
                <p>Creating a new report notifies the site's primary vendor.</p>
            </div>
        </div>


        <div class="table-wrapper">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Net Site</th>
                        <th>Branch</th>
                        <th>Issue Type</th>
                        <th>Reported By</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($siteIssues as $siteIssue)

                        @php
                            $status = $siteIssue->currentStatusLog->status ?? null;
                        @endphp

                        <tr>
                            <td>
                                {{ $loop->iteration + ($siteIssues->currentPage() - 1) * $siteIssues->perPage() }}
                            </td>

                            <td>
                                <div class="table-primary-text">{{ $siteIssue->netSite->name ?? '-' }}</div>
                            </td>

                            <td>{{ $siteIssue->netSite->branch->name ?? '-' }}</td>

                            <td>{{ $siteIssue->netIssue->name ?? '-' }}</td>

                            <td>{{ $siteIssue->employee->name ?? '-' }}</td>

                            <td>
                                <span class="status-badge status-{{ $status->code ?? 'none' }}">
                                    {{ $status->name ?? 'No status' }}
                                </span>
                            </td>

                            <td>
                                <div class="table-secondary-text">
                                    {{ $siteIssue->remark ?? '-' }}
                                </div>
                            </td>

                            <td class="text-right">
                                <div class="table-actions">

                                    <a href="{{ route('site-issues.edit', $siteIssue) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('site-issues.destroy', $siteIssue) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus laporan issue ini?')"
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
                            <td colspan="8" class="empty-table">
                                <div class="empty-table-icon">◇</div>
                                <div class="empty-table-title">Belum ada laporan Site Issue</div>
                                <div class="empty-table-text">Buat laporan baru untuk mulai mencatat gangguan.</div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{ $siteIssues->links('partials.pagination') }}

    </div>

</div>

@endsection