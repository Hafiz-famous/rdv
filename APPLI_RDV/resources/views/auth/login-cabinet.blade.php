<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Cabinet - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin: 8rem auto; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card p-4 shadow">
            <h2 class="text-center mb-4" style="color: #005BAC;">Connexion Cabinet</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" style="background-color: #005BAC;">Se connecter</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('cabinets.register.show') }}" class="small">S'inscrire comme cabinet</a>
            </div>
        </div>
    </div>
</body>
</html>