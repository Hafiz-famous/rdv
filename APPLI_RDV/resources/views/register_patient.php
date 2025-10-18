<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Patient - Médilink</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

  <style>
    body {
      background: url('images/medical-bg.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
    }

    /* effet de flou sur le fond */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      backdrop-filter: blur(6px);
      background: rgba(255, 255, 255, 0.2);
      z-index: 1;
    }

    .register-card {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.92);
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
      width: 420px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }

    .brand {
      font-family: 'Pacifico', cursive;
      color: #005BAC;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    h4 {
      font-weight: 700;
      color: #003f7f;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px;
      border: 1px solid #ccc;
    }

    .btn-primary {
      background-color: #005BAC;
      border: none;
      border-radius: 10px;
      padding: 10px 0;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .btn-primary:hover {
      background-color: #003f7f;
      transform: translateY(-2px);
    }

    .text-muted a {
      color: #005BAC;
      text-decoration: none;
      font-weight: 600;
    }

    .text-muted a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="register-card">
    <div class="brand">Médilink</div>
    <h4>Créer un compte Patient</h4>

    <form action="register_patient_traitement.php" method="POST">
      <div class="mb-3 text-start">
        <label for="nom" class="form-label fw-semibold">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" required>
      </div>

      <div class="mb-3 text-start">
        <label for="prenom" class="form-label fw-semibold">Prénom</label>
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
      </div>

      <div class="mb-3 text-start">
        <label for="age" class="form-label fw-semibold">Âge</label>
        <input type="number" id="age" name="age" class="form-control" placeholder="Ex : 25" required>
      </div>

      <div class="mb-3 text-start">
        <label for="email" class="form-label fw-semibold">Adresse Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@email.com" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label fw-semibold">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 mt-3">S’inscrire</button>

      <p class="text-center text-muted mt-4">
        Vous avez déjà un compte ?
        <a href="login_patient.php">Se connecter</a>
      </p>
    </form>
  </div>

</body>
</html>
