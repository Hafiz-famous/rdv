@extends('layouts.app') 

@section('content')

<style>
    /* Style spécifique aux cartes de statistiques */
    .kpi-card {
        background-color: white;
        border-left: 5px solid #005BAC; /* Couleur Médilink */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }
    .kpi-card h2 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1063a8ff;
    }
    .kpi-card p {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 0;
    }
</style>

<main class="pt-5 mt-5" style="min-height: 80vh;">
    <div class="container py-5">
        <h1 class="mb-5 fw-bold" style="color:#002D62;">📊 Tableau de Bord : États et Statistiques</h1>
        
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="kpi-card">
                    <h2>8,500</h2>
                    <p>Total Rendez-vous Planifiés</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card" style="border-left: 5px solid #28a745;">
                    <h2>92%</h2>
                    <p>Taux de Confirmation des RDV</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card" style="border-left: 5px solid #ffc107;">
                    <h2>12</h2>
                    <p>Médecins Actifs (derniers 30 jours)</p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-bold text-white" style="background-color:#1063a8ff;">
                Rapport Mensuel : Répartition des Rendez-vous (Octobre)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f1f7fc;">
                            <tr>
                                <th scope="col">Spécialité</th>
                                <th scope="col">Nombre de RDV</th>
                                <th scope="col">Moyenne Jours d'Attente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Médecine Générale</td>
                                <td>2,120</td>
                                <td>1.5 jours</td>
                            </tr>
                            <tr>
                                <td>Pédiatrie</td>
                                <td>890</td>
                                <td>2.3 jours</td>
                            </tr>
                            <tr>
                                <td>Gynécologie</td>
                                <td>540</td>
                                <td>4.1 jours</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection