<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À Propos de Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
    <style>
        body { padding-top: 70px; }
        .hero-about {
            /* ✅ Image en arrière-plan ici */
            background: linear-gradient(rgba(0, 91, 172, 0.7), rgba(0, 45, 98, 0.8)), 
                        url('https://source.unsplash.com/1600x600/?hospital,africa') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 6rem 0;
            text-align: center;
        }
        .mission-icon { font-size: 3rem; color: #005BAC; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <header class="hero-about">
        <div class="container">
            <h1 class="display-4 fw-bold">Notre Mission : Moderniser la Santé au Togo</h1>
            <p class="lead col-md-8 mx-auto">
                Médilink est né d'un constat simple : la gestion manuelle des dossiers médicaux et des rendez-vous freine l'efficacité des soins. Notre objectif est de transformer cette réalité.
            </p>
        </div>
    </header>

    <main class="container py-5">
        <section class="mb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold" style="color: #003366;">Le Contexte et la Problématique</h2>
                    <p class="text-muted">
                        [cite_start]Au Togo, de nombreux centres de santé s'appuient encore sur des registres papier[cite: 146]. [cite_start]Cette méthode traditionnelle, bien qu'établie, entraîne des pertes de dossiers, des erreurs, des files d'attente interminables et un manque de données fiables pour la prise de décision stratégique[cite: 176, 177, 179]. [cite_start]Face à ces défis, la transition numérique n'est plus une option, mais une nécessité pour améliorer la qualité des services de santé[cite: 184].
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/illustration_probleme.png') }}" alt="Dossiers papier" class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </section>

        <hr class="my-5">

        <section class="text-center">
            <h2 class="fw-bold mb-5" style="color: #003366;">Nos Engagements</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="mission-icon mb-3">🗂️</div>
                        <h5 class="fw-bold">Centralisation & Sécurité</h5>
                        [cite_start]<p>Nous offrons une plateforme unique pour centraliser les dossiers patients de manière sécurisée, garantissant l'intégrité et la confidentialité des informations médicales sensibles[cite: 195].</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="mission-icon mb-3">📅</div>
                        <h5 class="fw-bold">Optimisation des Rendez-vous</h5>
                        [cite_start]<p>Notre système de planification intelligent et de rappels automatiques vise à réduire les temps d'attente et à fluidifier le parcours du patient au sein du centre de santé[cite: 197].</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="mission-icon mb-3">❤️</div>
                        <h5 class="fw-bold">Amélioration de la Qualité des Soins</h5>
                        [cite_start]<p>En libérant le personnel médical des tâches administratives, nous leur permettons de se concentrer sur l'essentiel : offrir des soins de qualité et un meilleur suivi à chaque patient[cite: 200].</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>
</html>