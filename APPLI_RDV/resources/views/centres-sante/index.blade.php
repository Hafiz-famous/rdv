{{-- Page centres-sante/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Centres de Santé - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    {{-- ... autres styles ... --}}
    <style>
        body { padding-top: 70px; background-color:#f8f9fa; }
        /* ... styles de base ... */
        .navbar { background-color:#005BAC; }
        .navbar a { color:#fff !important; }
        .navbar-brand { font-family:'Pacifico', cursive; font-size:2rem; }
        .page-header { background-color: #004a88; color: white; padding: 60px 0; }
        .centre-card { transition: all 0.3s; }
        .centre-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,.12); }
    </style>
</head>
<body>
    @include('partials.navbar')

    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Nos Centres de Santé</h1>
            <p class="lead">Trouvez un établissement de confiance près de chez vous.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="row g-4">
            {{-- @foreach($centres as $centre) --}}
            <div class="col-md-6">
                <div class="card centre-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">Clinique Les Bérets Verts {{-- {{ $centre->nom }} --}}</h5>
                        <p class="card-text">123 Rue de la Santé, Lomé {{-- {{ $centre->adresse }} --}}</p>
                        <p class="small text-muted">Spécialités : Médecine générale, Pédiatrie...</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir les médecins</a>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </main>
</body>
</html>