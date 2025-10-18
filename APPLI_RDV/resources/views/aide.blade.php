<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aide et Support - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
    <style>
        body { padding-top: 70px; background-color: #f4f7f6; }
        .page-header { background-color: #005BAC; color: white; padding: 4rem 0; text-align: center; }
        .accordion-button:not(.collapsed) { background-color: #e7f1ff; color: #005BAC; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <header class="page-header">
        <div class="container">
            <h1>Centre d'Aide</h1>
            <p class="lead">Nous sommes là pour répondre à vos questions.</p>
        </div>
    </header>

    <main class="container py-5">
        <h2 class="text-center mb-4">Questions Fréquentes (FAQ)</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        Comment puis-je prendre un rendez-vous ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour prendre un rendez-vous, utilisez la barre de recherche sur la page d'accueil pour trouver un médecin ou une spécialité. Une fois sur le profil du praticien, vous pourrez voir ses disponibilités et choisir un créneau qui vous convient.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Comment puis-je consulter mon dossier médical ?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Après vous être connecté à votre compte patient, accédez à votre tableau de bord. Vous y trouverez une section "Mon Dossier Médical" où vous pourrez consulter l'historique de vos consultations et vos prescriptions.
                    </div>
                </div>
            </div>
            </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>