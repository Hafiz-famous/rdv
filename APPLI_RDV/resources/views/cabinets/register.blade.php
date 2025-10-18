<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscrire votre Centre de Santé - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef5f9; }
        .register-container { max-width: 600px; margin: 5rem auto; }
        .card { border: none; box-shadow: 0 4px 15px rgba(0,0,0,.1); }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="card p-4 p-md-5">
            <h2 class="text-center mb-4" style="color: #005BAC;">Inscrire votre établissement</h2>
            <p class="text-center text-muted mb-4">Rejoignez le réseau Médilink pour moderniser la gestion de vos patients.</p>

            <form action="{{-- route('cabinets.register.submit') --}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom_hopital" class="form-label">Nom de l'hôpital ou du cabinet</label>
                    <input type="text" class="form-control" id="nom_hopital" name="nom_hopital" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse complète</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background-color: #005BAC;">S'inscrire</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted">Déjà inscrit ? <a href="{{ route('cabinets.login.show') }}">Connectez-vous ici</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>