@extends('layouts.app')

@section('content')

<style>
* Arrière-plan qui couvre toute la page */
.bg-form {
    background-image: url('{{ asset("images/medical_bg.jpg") }}');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    justify-content: center; /* centrer verticalement */
    align-items: center;     /* centrer horizontalement */
    padding: 2rem;           /* espace autour du formulaire */
}

/* Card du formulaire avec un léger overlay pour mieux voir le texte */
.card {
    background-color: rgba(255, 255, 255, 0.95); /* semi-transparent blanc */
    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    width: 100%;
    max-width: 600px; /* plus large pour plus de confort */
    padding: 2rem;    /* espace interne du formulaire */
}


/* Labels en gras et taille légèrement augmentée */
.form-label {
    font-weight: bold;
    font-size: 1rem;
}

/* Titre du formulaire */
.card h2 {
    font-weight: bold;
    font-family: 'Times New Roman', serif; /* titre en Times New Roman */
    color: #070a0dff; /* couleur bleu foncé */
}

/* Bouton stylé */
.btn-primary {
    background-color: #084f9cff; /* bleu Médilink */
    border: none;
    font-weight: bold;
}

/* Navbar cohérente avec l’accueil */
.navbar-brand {
    font-family: 'Pacifico', cursive; /* police logo */
    font-weight: bold;
    color: #ffffff !important; /* blanc pour le logo */
}

.nav-link {
    font-family: 'Segoe UI', serif; /* autre police pour les liens */
    font-weight: bold;
    color: #ffffff !important; /* blanc pour les liens */
    margin-left: 1rem;
}

/* Au survol, on peut ajouter un effet léger */
.nav-link:hover {
    color: #0b498cff !important; /* bleu Médilink au hover */
}

/* Responsive sur mobile */
@media (max-width: 768px) {
    .card {
        margin: 1rem;
    }
}

/* Responsive sur mobile */
@media (max-width: 768px) {
    .card {
        margin: 1rem;
    }
}
</style>

<div class="bg-form">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card p-4">
                <h2 class="text-center mb-4">Inscription Patient</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('register.patient.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nom</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date de naissance</label>
                        <input type="date" name="dob" id="dob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse postale</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="insurance" class="form-label">Compagnie d’assurance (facultatif)</label>
                        <input type="text" name="insurance" id="insurance" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>

                <p class="mt-3 text-center">
                    Vous avez déjà un compte ? <a href="#">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
