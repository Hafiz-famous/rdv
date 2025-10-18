<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard') – Médilink</title>

    {{-- Bootstrap + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root { --sidebar-width: 260px; }
        body { background-color:#f5f7fa; }
        .app-navbar { height: 56px; }
        .sidebar {
            width: var(--sidebar-width);
            top: 56px; bottom: 0; left: 0;
            position: fixed; background:#005BAC; color:#fff;
            padding: 1rem; overflow-y:auto;
        }
        .sidebar .nav-link { color: #e6eef7; border-radius:.375rem; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,.12); color: #fff; }
        .sidebar .nav-link.active { background: #004a88; color:#fff; font-weight: 600; }
        .main {
            margin-left: var(--sidebar-width); padding: 1.25rem;
            min-height: calc(100vh - 56px);
        }
        @media (max-width: 991.98px) { /* lg- */
            .sidebar { display:none; }
            .main { margin-left:0; }
        }
    </style>

    @stack('styles')
    @yield('styles')
</head>
<body class="d-flex flex-column h-100">

    {{-- TOP NAV --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top app-navbar">
        <div class="container-fluid">
            <button class="btn btn-outline-light d-lg-none me-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">Médilink</a>

            <div class="ms-auto d-flex align-items-center gap-3 me-2">
                {{-- (optionnel) champ recherche global --}}
                {{-- <form class="d-none d-md-flex" method="GET" action="{{ url()->current() }}">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Rechercher…">
                    </div>
                </form> --}}

                <div class="dropdown">
                    <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        {{ auth()->user()->name ?? 'Utilisateur' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Connecté</h6></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="bi bi-globe me-2"></i> Aller au site
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- SIDEBAR (desktop) --}}
    <aside class="sidebar d-none d-lg-block">
        @yield('sidebar')
    </aside>

    {{-- OFFCANVAS SIDEBAR (mobile) --}}
    <div class="offcanvas offcanvas-start text-bg-primary" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Médilink</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
        <div class="offcanvas-body">
            @yield('sidebar')
        </div>
    </div>

    {{-- MAIN --}}
    <main class="main pt-4">
        {{-- Breadcrumbs & Messages --}}
        @hasSection('breadcrumbs')
            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </nav>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center py-3 small text-muted">
        © {{ now()->year }} Médilink — Dashboard
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
