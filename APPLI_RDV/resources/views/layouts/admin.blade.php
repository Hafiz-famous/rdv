<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Médilink — Admin')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Alpine.js (toggle sidebar, menus) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Vite (si tu utilises des assets locaux) --}}
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}

    @stack('head')
</head>
<body class="h-full bg-gray-100" x-data="{ sidebarOpen:false, userMenu:false }">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 z-30 w-72 bg-white shadow-lg transform transition-transform
                       lg:static lg:translate-x-0"
               :class="{'-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen}">
            {{-- Brand --}}
            <div class="flex items-center justify-between px-6 h-16 border-b">
                <div class="text-center">
                    <h1 class="font-bold text-xl text-blue-600">Médilink</h1>
                    <p class="text-gray-500 text-xs tracking-wide">Administration</p>
                </div>
                <button class="lg:hidden text-gray-600 hover:text-gray-900"
                        @click="sidebarOpen=false" aria-label="Fermer le menu">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="px-4 py-4 overflow-y-auto">
                <ul class="space-y-1">

                    {{-- Accueil --}}
                    <li>
                        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm
                                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-home w-5 text-current"></i>
                            <span>Accueil</span>
                        </a>
                    </li>

                    {{-- Utilisateurs --}}
                    <li>
                        <a href="{{ Route::has('admin.users') ? route('admin.users') : '#' }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm
                                  {{ request()->routeIs('admin.users*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-users w-5 text-current"></i>
                            <span>Gérer les utilisateurs</span>
                        </a>
                    </li>

                    {{-- Rendez-vous (admin) --}}
                    <li>
                        <a href="{{ Route::has('admin.rendezvous') ? route('admin.rendezvous') : '#' }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm
                                  {{ request()->routeIs('admin.rendezvous*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-calendar-check w-5 text-current"></i>
                            <span>Rendez-vous</span>
                        </a>
                    </li>

                    {{-- Rapports / Statistiques --}}
                    <li>
                        <a href="{{ Route::has('admin.statistiques') ? route('admin.statistiques') : '#' }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm
                                  {{ request()->routeIs('admin.statistiques') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-chart-line w-5 text-current"></i>
                            <span>Rapports</span>
                        </a>
                    </li>

                    {{-- Paramètres (placeholder) --}}
                    <li>
                        <a href="{{ Route::has('admin.settings') ? route('admin.settings') : '#' }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm
                                  {{ request()->routeIs('admin.settings') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-gear w-5 text-current"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>

                    <li class="pt-2 border-t"></li>

                    {{-- Retour au site public --}}
                    <li>
                        <a href="{{ route('home') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                            <i class="fa-solid fa-arrow-left w-5"></i>
                            <span>Retour au site</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- OVERLAY mobile --}}
        <div class="fixed inset-0 bg-black/30 z-20 lg:hidden"
             x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen=false"></div>

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="h-16 bg-white border-b flex items-center justify-between px-4 lg:px-6">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden text-gray-700" @click="sidebarOpen=true" aria-label="Ouvrir le menu">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-base font-semibold">@yield('title','Dashboard')</h2>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Recherche (optionnelle) --}}
                    <form action="{{ url()->current() }}" method="GET" class="hidden md:block">
                        <label class="relative">
                            <input name="q" value="{{ request('q') }}" placeholder="Rechercher…"
                                   class="w-64 rounded-md border-gray-300 pl-9 pr-3 py-1.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        </label>
                    </form>

                    {{-- User menu --}}
                    <div class="relative">
                        <button class="flex items-center gap-2 px-2 py-1.5 rounded-md hover:bg-gray-50"
                                @click="userMenu=!userMenu" @click.outside="userMenu=false" aria-haspopup="true" :aria-expanded="userMenu">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=1d4ed8&color=fff"
                                 class="w-8 h-8 rounded-full" alt="Avatar">
                            <span class="hidden sm:block text-sm text-gray-700">{{ auth()->user()->name ?? 'Administrateur' }}</span>
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-10"
                             x-show="userMenu" x-transition>
                            <div class="px-3 py-2 text-xs text-gray-500">
                                Connecté en tant que<br>
                                <span class="font-medium text-gray-700">{{ auth()->user()->email ?? 'admin@medilink' }}</span>
                            </div>
                            <div class="border-t"></div>
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">
                                <i class="fa-solid fa-gauge-high mr-2 text-gray-500"></i> Mon tableau de bord
                            </a>
                            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">
                                <i class="fa-solid fa-globe mr-2 text-gray-500"></i> Aller au site
                            </a>
                            <div class="border-t"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Breadcrumbs + Alertes --}}
            <div class="px-4 lg:px-6 py-3 border-b bg-gray-50">
                @hasSection('breadcrumbs')
                    <nav class="text-sm text-gray-600">@yield('breadcrumbs')</nav>
                @endif

                @if (session('status'))
                    <div class="mt-3 rounded-md bg-green-50 border border-green-200 text-green-800 px-3 py-2 text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mt-3 rounded-md bg-red-50 border border-red-200 text-red-800 px-3 py-2 text-sm">
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- CONTENU --}}
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="px-6 py-3 text-xs text-gray-500 border-t bg-white">
                © {{ now()->year }} Médilink — Administration
            </footer>
        </div>
    </div>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
