{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Médilink')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- Styles additionnels injectés depuis les vues --}}
  @stack('styles')

  <style>
    /* Si la navbar est fixed-top, on évite qu’elle chevauche le contenu */
    body { padding-top: 56px; background-color: #f7f9fb; }
    .container-narrow { max-width: 1080px; }
  </style>
</head>
<body>

  {{-- Navbar publique (assure-toi que partials/navbar.blade.php existe) --}}
  @include('partials.navbar')

  {{-- Zone header/hero optionnelle --}}
  @hasSection('hero')
    <header class="mb-4">
      @yield('hero')
    </header>
  @endif

  {{-- Messages globaux --}}
  <div class="container container-narrow">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        <strong>Veuillez corriger les champs suivants :</strong>
        <ul class="mb-0 mt-1">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
      </div>
    @endif
  </div>

  {{-- Contenu principal --}}
  <main class="container container-narrow py-4">
    @yield('content')
  </main>

  {{-- Footer simple --}}
  <footer class="border-top py-4 mt-5">
    <div class="container container-narrow d-flex flex-column flex-md-row justify-content-between small text-muted">
      <span>© {{ date('Y') }} Médilink</span>
      <span>
        <a href="{{ route('aide') }}" class="text-decoration-none">Aide</a>
        <span class="mx-2">·</span>
        <a href="{{ route('apropos') }}" class="text-decoration-none">À propos</a>
      </span>
    </div>
  </footer>

  {{-- JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Scripts additionnels injectés depuis les vues --}}
  @stack('scripts')
  @yield('scripts') {{-- compatibilité si tu utilises déjà @section('scripts') --}}
</body>
</html>
