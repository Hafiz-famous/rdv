<!doctype html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>@yield('title','Médilink')</title>
  <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
</head>
<body>
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
  <div class=\"container-fluid\">
    <a class=\"navbar-brand\" href=\"{{ route('home') }}\">Médilink</a>
    <div class=\"d-flex\">
      @auth
      <form method=\"POST\" action=\"{{ route('logout') }}\">
        @csrf
        <button class=\"btn btn-outline-light btn-sm\">Se déconnecter</button>
      </form>
      @endauth
      @guest
      <a href=\"{{ route('login') }}\" class=\"btn btn-outline-light btn-sm ms-2\">Connexion</a>
      @endguest
    </div>
  </div>
</nav>
<main class=\"container py-4\">
  @if (session('success'))
    <div class=\"alert alert-success\">{{ session('success') }}</div>
  @endif
  @yield('content')
</main>
</body>
</html>
