{{-- Page specialites/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Spécialités Médicales - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    {{-- ... autres liens CSS ... --}}
    <style>
        body { padding-top: 70px; background-color:#f9fbff; }
        /* Copiez ici les styles .navbar et .specialite-card de votre fichier original */
        .navbar { background-color:#005BAC; }
        .navbar a { color:#fff !important; }
        .navbar-brand { font-family:'Pacifico', cursive; font-size:2rem; }
        .specialite-card {
            background: white; border-radius: 15px; transition: all 0.4s ease; border: 1px solid #e1e1e1;
        }
        .specialite-card:hover {
            background-color: #005BAC; color: white !important; transform: translateY(-8px); box-shadow: 0px 6px 20px rgba(0, 91, 172, 0.3);
        }
        .specialite-card:hover p, .specialite-card:hover h6 { color: #f0f0f0 !important; }
        .specialite-link { text-decoration: none; color: inherit; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold" style="color:#003366;">🌿 Parcourir les spécialités médicales</h2>
        <div class="row g-4">
            
            <div class="col-md-3 col-sm-6">
              <a href="{{ route('specialites.show', ['slug' => 'cardiologie']) }}" class="specialite-link">
                <div class="specialite-card text-center p-4 shadow-sm">
                  <img src="{{ asset('images/cardio.png') }}" alt="Cardiologie" width="70" class="mb-3">
                  <h6 class="fw-bold">Cardiologie</h6>
                  <p class="text-muted small">Soins du cœur et du système circulatoire.</p>
                </div>
              </a>
            </div>

            <div class="col-md-3 col-sm-6">
              <a href="{{ route('specialites.show', ['slug' => 'dermatologie']) }}" class="specialite-link">
                <div class="specialite-card text-center p-4 shadow-sm">
                  <img src="{{ asset('images/dermato.png') }}" alt="Dermatologie" width="70" class="mb-3">
                  <h6 class="fw-bold">Dermatologie</h6>
                  <p class="text-muted small">Soins de la peau, des cheveux et des ongles.</p>
                </div>
              </a>
            </div>

            </div>
    </div>
</body>
</html>