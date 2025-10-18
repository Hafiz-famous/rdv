@extends('layouts.app')
@section('title','Dossier médical')

@section('sidebar') 
  @include('partials.sidebar-patient') 
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="mb-0">Mon dossier médical</h1>
    <small class="text-muted">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</small>
  </div>

  <div class="btn-group">
    <a class="btn btn-outline-secondary" href="#"><i class="bi bi-download me-1"></i>Exporter (PDF)</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNouveauDoc">
      <i class="bi bi-file-earmark-plus me-1"></i> Ajouter un document
    </button>
  </div>
</div>

{{-- Bandeaux d’info --}}
<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="text-muted mb-2">Consultations</h6>
          <i class="bi bi-clipboard2-pulse fs-4 text-primary"></i>
        </div>
        <div class="fs-3 fw-bold">4</div>
        <small class="text-muted">12 derniers mois</small>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="text-muted mb-2">Allergies</h6>
          <i class="bi bi-exclamation-triangle fs-4 text-warning"></i>
        </div>
        <div class="fs-3 fw-bold">2</div>
        <small class="text-muted">Déclarées</small>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="text-muted mb-2">Vaccins</h6>
          <i class="bi bi-shield-check fs-4 text-success"></i>
        </div>
        <div class="fs-3 fw-bold">8</div>
        <small class="text-muted">À jour</small>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="text-muted mb-2">Documents</h6>
          <i class="bi bi-folder2-open fs-4 text-info"></i>
        </div>
        <div class="fs-3 fw-bold">12</div>
        <small class="text-muted">Analyses & ordonnances</small>
      </div>
    </div>
  </div>
</div>

{{-- Filtres rapides --}}
<div class="card border-0 shadow-sm mb-4">
  <div class="card-body">
    <form class="row g-2">
      <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Rechercher (médecin, mot-clé, examen…)">
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option selected>Tous types</option>
          <option>Consultation</option>
          <option>Ordonnance</option>
          <option>Analyse</option>
          <option>Imagerie</option>
        </select>
      </div>
      <div class="col-md-3">
        <input type="month" class="form-control">
      </div>
      <div class="col-md-2 d-grid">
        <button class="btn btn-outline-primary"><i class="bi bi-funnel me-1"></i>Filtrer</button>
      </div>
    </form>
  </div>
</div>

<div class="row g-4">
  {{-- Chronologie des consultations --}}
  <div class="col-lg-7">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white">
        <strong><i class="bi bi-activity me-2"></i>Historique des consultations</strong>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          {{-- Exemple d’item --}}
          <li class="list-group-item d-flex">
            <div class="me-3 text-center" style="width: 70px;">
              <div class="fw-bold">22</div>
              <div class="text-muted small">Oct</div>
            </div>
            <div class="flex-fill">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="badge bg-primary-subtle text-primary border border-primary-subtle me-2">Consultation</span>
                  <strong>Dr Komlan (Cardiologie)</strong>
                </div>
                <a href="#" class="small text-decoration-none"><i class="bi bi-file-earmark-text me-1"></i>Compte rendu</a>
              </div>
              <div class="text-muted small mt-1">
                Motif : palpitations · Tension 12/7 · ECG OK. Bilan sanguin demandé.
              </div>
            </div>
          </li>

          <li class="list-group-item d-flex">
            <div class="me-3 text-center" style="width: 70px;">
              <div class="fw-bold">05</div>
              <div class="text-muted small">Oct</div>
            </div>
            <div class="flex-fill">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="badge bg-success-subtle text-success border border-success-subtle me-2">Ordonnance</span>
                  <strong>Dr Akouvi (Pédiatrie)</strong>
                </div>
                <a href="#" class="small text-decoration-none"><i class="bi bi-prescription me-1"></i>Voir l’ordonnance</a>
              </div>
              <div class="text-muted small mt-1">
                Paracétamol 500mg (x10), Solution de réhydratation (x6).
              </div>
            </div>
          </li>

          <li class="list-group-item d-flex">
            <div class="me-3 text-center" style="width: 70px;">
              <div class="fw-bold">28</div>
              <div class="text-muted small">Sep</div>
            </div>
            <div class="flex-fill">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="badge bg-info-subtle text-info border border-info-subtle me-2">Analyse</span>
                  <strong>Laboratoire Central</strong>
                </div>
                <a href="#" class="small text-decoration-none"><i class="bi bi-filetype-pdf me-1"></i>Télécharger résultats</a>
              </div>
              <div class="text-muted small mt-1">
                NFS : normal · CRP : 4 mg/L · Glycémie : 0,95 g/L.
              </div>
            </div>
          </li>
        </ul>

        <div class="d-flex justify-content-end mt-3">
          <a href="#" class="btn btn-sm btn-outline-secondary">Voir tout l’historique</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Panneau latéral : Allergies / Vaccins / Documents --}}
  <div class="col-lg-5">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white">
        <strong><i class="bi bi-exclamation-triangle me-2"></i>Allergies</strong>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-start mb-2">
          <i class="bi bi-dot text-warning fs-3 me-2"></i>
          <div>
            <div class="fw-semibold">Pénicilline</div>
            <small class="text-muted">Éruption cutanée · Déclarée en 2018</small>
          </div>
        </div>
        <div class="d-flex align-items-start">
          <i class="bi bi-dot text-warning fs-3 me-2"></i>
          <div>
            <div class="fw-semibold">Arachide (faible)</div>
            <small class="text-muted">Précaution alimentaire</small>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white">
        <strong><i class="bi bi-shield-check me-2"></i>Vaccinations</strong>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
          <div>
            <div class="fw-semibold">Tétanos (DT)</div>
            <small class="text-muted">Rappel : 2023</small>
          </div>
          <span class="badge bg-success-subtle text-success border border-success-subtle">À jour</span>
        </div>
        <div class="d-flex justify-content-between align-items-center border rounded p-2">
          <div>
            <div class="fw-semibold">Hépatite B</div>
            <small class="text-muted">3/3 doses</small>
          </div>
          <span class="badge bg-success-subtle text-success border border-success-subtle">Complet</span>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong><i class="bi bi-folder2-open me-2"></i>Documents récents</strong>
        <a href="#" class="small text-decoration-none">Voir tous</a>
      </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
          <i class="bi bi-filetype-pdf me-3 fs-4 text-danger"></i>
          Bilan sanguin_2025-10-05.pdf
          <span class="ms-auto small text-muted">220 Ko</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
          <i class="bi bi-file-earmark-text me-3 fs-4 text-secondary"></i>
          Compte-rendu_cardiologie_2025-10-22.docx
          <span class="ms-auto small text-muted">72 Ko</span>
        </a>
      </div>
    </div>
  </div>
</div>

{{-- Ordonnances (table) --}}
<div class="card border-0 shadow-sm mt-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <strong><i class="bi bi-prescription me-2"></i>Mes ordonnances</strong>
    <div class="small text-muted">2 actives</div>
  </div>
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Date</th>
          <th>Médecin</th>
          <th>Médicaments</th>
          <th class="text-center">Statut</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>05/10/2025</td>
          <td>Dr Akouvi</td>
          <td>
            <span class="badge bg-secondary-subtle text-secondary border">Paracétamol</span>
            <span class="badge bg-secondary-subtle text-secondary border">ORS</span>
          </td>
          <td class="text-center"><span class="badge bg-success">Active</span></td>
          <td class="text-end">
            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
            <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i></a>
          </td>
        </tr>
        <tr>
          <td>12/09/2025</td>
          <td>Dr Komlan</td>
          <td><span class="badge bg-secondary-subtle text-secondary border">Bêtabloquant</span></td>
          <td class="text-center"><span class="badge bg-secondary">Terminée</span></td>
          <td class="text-end">
            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
            <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

{{-- Modal : nouveau document --}}
<div class="modal fade" id="modalNouveauDoc" tabindex="-1" aria-labelledby="modalNouveauDocLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="#" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalNouveauDocLabel">Ajouter un document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Type</label>
          <select class="form-select" name="type" required>
            <option value="Analyse">Analyse</option>
            <option value="Imagerie">Imagerie</option>
            <option value="Ordonnance">Ordonnance</option>
            <option value="Autre">Autre</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Titre</label>
          <input type="text" name="title" class="form-control" placeholder="Ex : Bilan sanguin 10/2025" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Fichier</label>
          <input type="file" name="file" class="form-control" accept=".pdf,.jpg,.png,.jpeg" required>
          <small class="text-muted">PDF, JPG, PNG · max 5 Mo</small>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
@endsection
