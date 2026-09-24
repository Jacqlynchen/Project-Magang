<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Avian Brands')
    </title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<div class="app-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        {{-- LOGO --}}
        <div class="sidebar-logo">
            <img
                src="{{ asset('images/avian-logo.png') }}"
                alt="Avian Brands"
            >
        </div>


        {{-- MENU --}}
        <nav class="sidebar-menu">

            {{-- DASHBOARD --}}
            <div class="menu-section-title">
                DASHBOARD
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>


            {{-- MASTER DATA --}}
            <div class="menu-section-title">
                MASTER DATA
            </div>

            <a
                href="{{ route('branches.index') }}"
                class="menu-item {{ request()->routeIs('branches.*') ? 'active' : '' }}"
            >
                <span class="menu-icon">▣</span>
                <span>Branches</span>
            </a>

            <a
                href="{{ route('net-sites.index') }}"
                class="menu-item {{ request()->routeIs('net-sites.*') ? 'active' : '' }}"
            >
                <span class="menu-icon">▤</span>
                <span>Net Sites</span>
            </a>

            <a
                href="{{ route('vendors.index') }}"
                class="menu-item {{ request()->routeIs('vendors.*') ? 'active' : '' }}"
            >
                <span class="menu-icon">◇</span>
                <span>Vendors</span>
            </a>

        </nav>


        {{-- ADMIN --}}
        <div class="sidebar-bottom">

            <div class="admin-profile">

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="admin-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Admin' }}
                    </strong>

                    <span>
                        Administrator
                    </span>

                </div>

            </div>


            {{-- LOGOUT --}}
            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <header class="topbar">

            <div>
                <h2>
                    @yield('title', 'Dashboard')
                </h2>
            </div>

            <div class="topbar-user">
                {{ auth()->user()->name ?? 'Admin' }}
            </div>

        </header>


        {{-- CONTENT --}}
        <div class="page-content">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>