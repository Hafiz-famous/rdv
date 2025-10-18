@extends('layouts.app')
@section('title','Profil')

@section('sidebar') 
  @include('partials.sidebar-patient') 
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="mb-0">Mon profil</h1>
    <small class="text-muted">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</small>
  </div>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditProfil">
    <i class="bi bi-pencil-square me-1"></i> Modifier
  </button>
</div>

<div class="row g-4">
  {{-- Colonne gauche --}}
  <div class="col-lg-4">
    {{-- Avatar --}}
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body text-center">
        <img src="{{ Auth::user()->avatar_url ?? 'https://i.pravatar.cc/180?u='.Auth::id() }}"
             class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
        <small class="text-muted d-block mb-3">{{ Auth::user()->email }}</small>

        <form class="d-grid gap-2" method="POST" action="{{ route('patient.avatar.update') }}" enctype="multipart/form-data">
          @csrf
          <input class="form-control" type="file" name="avatar" accept="image/*" required>
          <button class="btn btn-outline-primary btn-sm"><i class="bi bi-upload me-1"></i>Mettre à jour l’avatar</button>
        </form>
      </div>
    </div>

    {{-- Préférences --}}
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white">
        <strong><i class="bi bi-gear me-2"></i>Préférences</strong>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('patient.preferences.update') }}">
          @csrf
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" name="notif_email" id="notif_email" checked>
            <label class="form-check-label" for="notif_email">Notifications par email</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="notif_sms" id="notif_sms">
            <label class="form-check-label" for="notif_sms">Rappels SMS de rendez-vous</label>
          </div>
          <button class="btn btn-outline-secondary btn-sm">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>

  {{-- Colonne droite --}}
  <div class="col-lg-8">
    {{-- Informations personnelles --}}
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong><i class="bi bi-person-badge me-2"></i>Informations personnelles</strong>
        <span class="text-muted small">ID : {{ sprintf('P-%04d', Auth::id()) }}</span>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="text-muted small mb-1">Nom complet</label>
            <div class="fw-semibold">{{ Auth::user()->name }}</div>
          </div>
          <div class="col-md-6">
            <label class="text-muted small mb-1">Date de naissance</label>
            <div class="fw-semibold">{{ optional(Auth::user()->dob)->format('d/m/Y') ?? '—' }}</div>
          </div>
          <div class="col-md-6">
            <label class="text-muted small mb-1">Téléphone</label>
            <div class="fw-semibold">{{ Auth::user()->phone ?? '—' }}</div>
          </div>
          <div class="col-md-6">
            <label class="text-muted small mb-1">Adresse</label>
            <div class="fw-semibold">{{ Auth::user()->address ?? '—' }}</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Personne à contacter en cas d’urgence + Assurance --}}
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white">
            <strong><i class="bi bi-life-preserver me-2"></i>Contact d’urgence</strong>
          </div>
          <div class="card-body">
            <div class="mb-1 small text-muted">Nom & lien</div>
            <div class="fw-semibold">{{ Auth::user()->emergency_name ?? '—' }}</div>

            <div class="mb-1 mt-3 small text-muted">Téléphone</div>
            <div class="fw-semibold">{{ Auth::user()->emergency_phone ?? '—' }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white">
            <strong><i class="bi bi-shield-plus me-2"></i>Assurance</strong>
          </div>
          <div class="card-body">
            <div class="mb-1 small text-muted">Compagnie</div>
            <div class="fw-semibold">{{ Auth::user()->insurance_company ?? '—' }}</div>

            <div class="mb-1 mt-3 small text-muted">Numéro d’adhérent</div>
            <div class="fw-semibold">{{ Auth::user()->insurance_number ?? '—' }}</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Changer le mot de passe --}}
    <div class="card border-0 shadow-sm mt-4">
      <div class="card-header bg-white">
        <strong><i class="bi bi-key me-2"></i>Changer le mot de passe</strong>
      </div>
      <form class="card-body row g-3" method="POST" action="{{ route('patient.password.update') }}">
        @csrf
        <div class="col-md-6">
          <label class="form-label">Nouveau mot de passe</label>
          <input type="password" name="password" class="form-control" required minlength="8">
        </div>
        <div class="col-md-6">
          <label class="form-label">Confirmer le mot de passe</label>
          <input type="password" name="password_confirmation" class="form-control" required minlength="8">
        </div>
        <div class="col-12">
          <button class="btn btn-outline-primary">Mettre à jour</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal d’édition du profil --}}
<div class="modal fade" id="modalEditProfil" tabindex="-1" aria-labelledby="modalEditProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" method="POST" action="{{ route('patient.profile.update') }}">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditProfilLabel">Modifier mes informations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nom complet</label>
            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Date de naissance</label>
            <input type="date" class="form-control" name="dob" value="{{ optional(Auth::user()->dob)->format('Y-m-d') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Téléphone</label>
            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Adresse</label>
            <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact d’urgence</label>
            <input type="text" class="form-control" name="emergency_name" value="{{ Auth::user()->emergency_name }}" placeholder="Nom et lien (ex : frère)">
          </div>
          <div class="col-md-6">
            <label class="form-label">Téléphone d’urgence</label>
            <input type="text" class="form-control" name="emergency_phone" value="{{ Auth::user()->emergency_phone }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Assurance (compagnie)</label>
            <input type="text" class="form-control" name="insurance_company" value="{{ Auth::user()->insurance_company }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Numéro d’adhérent</label>
            <input type="text" class="form-control" name="insurance_number" value="{{ Auth::user()->insurance_number }}">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
@endsection
