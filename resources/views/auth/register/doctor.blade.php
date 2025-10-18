@extends('layouts.public')
@section('title','Créer un compte Médecin')

@section('content')
  <h1 class="mb-3">Créer un compte Médecin</h1>
  <p class="text-muted">Renseignez vos informations pour ouvrir votre espace professionnel.</p>

  {{-- Messages globaux --}}
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form class="card p-4 shadow-sm bg-white" method="POST" action="{{ route('register.medecin.submit') }}" novalidate>
    @csrf

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nom complet *</label>
        <input name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Mot de passe *</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
        <div class="form-text">8 caractères minimum.</div>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Confirmer le mot de passe *</label>
        <input type="password" name="password_confirmation" class="form-control" required minlength="8">
      </div>

      <div class="col-md-6">
        <label class="form-label">Spécialité *</label>
        <input name="specialite" class="form-control @error('specialite') is-invalid @enderror"
               value="{{ old('specialite') }}" required placeholder="Cardiologie, Pédiatrie…">
        @error('specialite')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">N° d’ordre (optionnel)</label>
        <input name="numero_ordre" class="form-control @error('numero_ordre') is-invalid @enderror"
               value="{{ old('numero_ordre') }}">
        @error('numero_ordre')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Cabinet / Établissement</label>
        <input name="cabinet" class="form-control @error('cabinet') is-invalid @enderror"
               value="{{ old('cabinet') }}">
        @error('cabinet')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Pays</label>
        <input name="pays" class="form-control @error('pays') is-invalid @enderror"
               value="{{ old('pays') }}">
        @error('pays')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Ville</label>
        <input name="ville" class="form-control @error('ville') is-invalid @enderror"
               value="{{ old('ville') }}">
        @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input @error('cgu') is-invalid @enderror" type="checkbox" id="cgu" name="cgu" value="1" {{ old('cgu') ? 'checked' : '' }} required>
          <label class="form-check-label" for="cgu">
            J’accepte les conditions d’utilisation.
          </label>
          @error('cgu')<div class="invalid-feedback">Vous devez accepter les conditions.</div>@enderror
        </div>
      </div>
    </div>

    <button class="btn btn-primary mt-3">
      <i class="bi bi-person-plus me-1"></i> Créer le compte
    </button>

    <div class="small mt-3">
      Déjà un compte ? <a class="text-decoration-none" href="{{ route('login', ['role' => 'medecin']) }}">Se connecter</a>
    </div>
  </form>
@endsection
