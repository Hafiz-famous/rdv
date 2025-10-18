@extends('layouts.app')
@section('title','Nouveau rendez-vous')

@section('content')
<div class="container py-4">
  <h1 class="mb-3">Prendre un rendez-vous</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Veuillez corriger les erreurs :</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form class="card p-4 shadow-sm border-0" method="POST" action="{{ route('rendezvous.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Médecin *</label>
      <select name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
        <option value="">Sélectionner…</option>
        @foreach($doctors as $d)
          <option value="{{ $d['id'] }}"
            @selected(old('doctor_id', $prefillDoctor) == $d['id'])>{{ $d['label'] }}</option>
        @endforeach
      </select>
      @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Date et heure *</label>
      <input type="datetime-local" name="scheduled_at"
             value="{{ old('scheduled_at') }}"
             class="form-control @error('scheduled_at') is-invalid @enderror" required>
      @error('scheduled_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <div class="form-text">Choisissez un créneau futur.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Motif (optionnel)</label>
      <textarea name="reason" rows="3" class="form-control @error('reason') is-invalid @enderror"
        placeholder="Ex. douleurs thoraciques depuis 2 jours…">{{ old('reason') }}</textarea>
      @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary"><i class="bi bi-calendar-check me-1"></i> Confirmer le RDV</button>
      <a href="{{ route('patient.dashboard') }}" class="btn btn-outline-secondary">Annuler</a>
    </div>
  </form>
</div>
@endsection
