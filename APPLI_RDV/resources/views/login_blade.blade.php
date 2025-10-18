<!-- resources/views/login_blade.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médilink - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
    /* Arrière-plan qui couvre toute la page */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .bg-login {
       background: url('images/medical-bg.jpg') no-repeat center center/cover;
        background-size: cover;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Style du formulaire */
    .login-form {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }



        /* Card du formulaire */
        .card-login {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .card-login h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0961bfff;
            font-family: 'Times New Roman', serif;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0c5098ff;
            border: none;
            font-weight: bold;
            width: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-family: serif;
        }
    </style>
</head>
<body>
<div class="bg-login">
    <div class="card-login">
        <h2>Se connecter</h2>
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Type de compte</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">-- Choisir --</option>
                    <option value="patient">Patient</option>
                    <option value="medecin">Médecin</option>
                    <option value="infirmier">Infirmier</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <div class="register-link">
            Vous n’avez pas de compte ? <a href="{{ route('register.patient') }}">S'inscrire</a>
        </div>
    </div>
</div>
</body>
</html>
