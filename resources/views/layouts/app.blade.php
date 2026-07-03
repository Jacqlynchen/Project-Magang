<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Master Data User</h2>

    @if(Auth::check())
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                Login sebagai:
                <strong>{{ Auth::user()->name }}</strong>

                @can('is-admin')
                    <span class="badge bg-success ms-2">
                        Admin
                    </span>
                @else
                    <span class="badge bg-secondary ms-2">
                        User
                    </span>
                @endcan
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>

        </div>
    @endif

    @yield('content')

</div>

</body>
</html>