{{-- resources/views/rendezvous/create.blade.php --}}
@extends('layouts.app')
@section('title','Nouveau rendez-vous')

@section('content')
<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="mb-0">Prendre un rendez-vous</h1>
    <a href="{{ url()->previous() }}" class="btn btn-light">
      <i class="bi bi-arrow-left"></i> Retour
    </a>
  </div>

  {{-- Messages d'erreur globaux --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Veuillez corriger les erreurs :</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  {{-- Message de succès (si besoin) --}}
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <form class="card p-4 shadow-sm border-0" method="POST" action="{{ route('rendezvous.store') }}" novalidate>
    @csrf

    {{-- Sélection du médecin --}}
    <div class="mb-3">
      <label class="form-label" for="doctor_id">Médecin <span class="text-danger">*</span></label>
      <select id="doctor_id" name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
        <option value="">Sélectionner…</option>
        @foreach($doctors as $d)
          <option value="{{ $d['id'] }}" @selected(old('doctor_id', $prefillDoctor) == $d['id'])>
            {{ $d['label'] }}
          </option>
        @endforeach
      </select>
      @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <div class="form-text">Choisissez le praticien souhaité.</div>
    </div>

    {{-- Date & heure --}}
    <div class="mb-3">
      <label class="form-label" for="scheduled_at">Date et heure <span class="text-danger">*</span></label>
      <input id="scheduled_at" type="datetime-local" name="scheduled_at"
             value="{{ old('scheduled_at') }}"
             class="form-control @error('scheduled_at') is-invalid @enderror" required>
      @error('scheduled_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <div class="form-text">Veuillez choisir un créneau futur.</div>
    </div>

    {{-- Motif (optionnel) --}}
    <div class="mb-3">
      <label class="form-label" for="reason">Motif (optionnel)</label>
      <textarea id="reason" name="reason" rows="3"
        class="form-control @error('reason') is-invalid @enderror"
        placeholder="Ex. douleurs thoraciques depuis 2 jours…">{{ old('reason') }}</textarea>
      @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <div class="form-text">Quelques précisions peuvent aider le praticien à préparer la consultation.</div>
    </div>

    {{-- Actions --}}
    <div class="d-flex flex-wrap gap-2">
      <button class="btn btn-primary">
        <i class="bi bi-calendar-check me-1"></i> Confirmer le RDV
      </button>
      <a href="{{ route('patient.dashboard') }}" class="btn btn-outline-secondary">Annuler</a>
    </div>
  </form>

  {{-- Astuce / rappel --}}
  <div class="alert alert-info mt-4 mb-0">
    <i class="bi bi-info-circle me-1"></i>
    Les créneaux affichés doivent être disponibles. En cas d’indisponibilité du médecin, vous serez recontacté pour une reprogrammation.
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Empêche la sélection d'une date passée côté client (la validation serveur reste indispensable)
  (function () {
    const input = document.getElementById('scheduled_at');
    if (!input) return;
    const now = new Date();
    // Arrondir à 5 minutes
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    const rounded = new Date(Math.ceil(now.getTime() / (5*60*1000)) * (5*60*1000));
    input.min = rounded.toISOString().slice(0,16);
  })();
</script>
@endpush
