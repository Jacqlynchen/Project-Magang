@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-page">

    {{-- HEADER --}}
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Overview of network management data.</p>
    </div>


    {{-- SUMMARY --}}
    <div class="dashboard-stats">

        <div class="dashboard-stat-card">
            <div class="stat-icon">▣</div>

            <div class="stat-content">
                <span>Total Branches</span>
                <strong>{{ $totalBranches ?? 0 }}</strong>
            </div>
        </div>


        <div class="dashboard-stat-card">
            <div class="stat-icon">▦</div>

            <div class="stat-content">
                <span>Net Sites</span>
                <strong>{{ $totalNetSites ?? 0 }}</strong>
            </div>
        </div>


        <div class="dashboard-stat-card">
            <div class="stat-icon">◇</div>

            <div class="stat-content">
                <span>Vendors</span>
                <strong>{{ $totalVendors ?? 0 }}</strong>
            </div>
        </div>

    </div>


    {{-- CONTENT --}}
    <div class="dashboard-two-column">

        {{-- QUICK ACCESS --}}
        <div class="dashboard-panel">

            <div class="dashboard-panel-header">
                <h2>Quick Access</h2>
                <p>Access important master data.</p>
            </div>


            <a href="{{ route('branches.index') }}"
               class="quick-access-item">

                <div class="quick-icon">▣</div>

                <div class="quick-text">
                    <strong>Branches</strong>
                    <span>Manage company branch locations</span>
                </div>

                <div class="quick-arrow">→</div>

            </a>


            <a href="#" class="quick-access-item">

                <div class="quick-icon">▦</div>

                <div class="quick-text">
                    <strong>Net Sites</strong>
                    <span>Manage network site information</span>
                </div>

                <div class="quick-arrow">→</div>

            </a>


            <a href="#" class="quick-access-item">

                <div class="quick-icon">◇</div>

                <div class="quick-text">
                    <strong>Vendors</strong>
                    <span>Manage vendor information</span>
                </div>

                <div class="quick-arrow">→</div>

            </a>

        </div>


        {{-- OVERVIEW --}}
        <div class="dashboard-panel">

            <div class="dashboard-panel-header">
                <h2>Network Overview</h2>
                <p>Summary of available network data.</p>
            </div>


            <div class="overview-item">

                <div class="overview-icon">▣</div>

                <div class="overview-content">
                    <strong>Branches</strong>
                    <span>Company branch locations</span>
                </div>

                <div class="overview-number">
                    {{ $totalBranches ?? 0 }}
                </div>

            </div>


            <div class="overview-item">

                <div class="overview-icon">▦</div>

                <div class="overview-content">
                    <strong>Net Sites</strong>
                    <span>Network site locations</span>
                </div>

                <div class="overview-number">
                    {{ $totalNetSites ?? 0 }}
                </div>

            </div>


            <div class="overview-item">

                <div class="overview-icon">◇</div>

                <div class="overview-content">
                    <strong>Vendors</strong>
                    <span>Network service vendors</span>
                </div>

                <div class="overview-number">
                    {{ $totalVendors ?? 0 }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection