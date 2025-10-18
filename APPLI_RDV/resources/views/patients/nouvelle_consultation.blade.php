@extends('layouts.app')

@section('title', 'Nouveau acte médical')

{{-- Styles spécifiques --}}
@push('styles')
<style>
    .consultation-bg {
        background-image:
            linear-gradient(rgba(141, 194, 246, .95), rgba(201, 228, 255, 1)),
            url('{{ asset('images/fond-dossier.jpg') }}');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        padding-top: 5rem; /* espace pour navbar fixed-top */
    }
    .card-consultation { border-top: 5px solid #1063a8; }
</style>
@endpush

@section('content')
<div class="consultation-bg">
    <main class="pt-5 mt-5">
        <div class="container py-5">
            <h1 class="mb-4 fw-bold" style="color:#002D62;">📝 Nouveau acte médical</h1>

            {{-- Alertes flash --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-lg mb-5 mx-auto card-consultation" style="max-width: 900px;">
                <div class="card-header text-white fw-bold d-flex flex-wrap justify-content-between align-items-center" style="background-color:#1063a8;">
                    <div>
                        Dossier patient :
                        <span class="text-warning">
                            {{ $patient->nom_complet ?? '—' }}
                            @if(!empty($patient->code)) ({{ $patient->code }}) @endif
                        </span>
                        — Âge : {{ $patient->age ?? '—' }} ans
                    </div>
                    @if(!empty($patient->numero_dossier))
                        <small class="opacity-75">N° dossier : {{ $patient->numero_dossier }}</small>
                    @endif
                </div>

                <div class="card-body p-4">
                    {{-- Adapte la route et le paramètre patient --}}
                    <form method="POST" action="{{ route('consultations.store', $patient->id ?? null) }}" novalidate>
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="date_consultation" class="form-label fw-bold">Date de la consultation</label>
                                <input
                                    type="date"
                                    class="form-control @error('date_consultation') is-invalid @enderror"
                                    id="date_consultation"
                                    name="date_consultation"
                                    value="{{ old('date_consultation', now()->toDateString()) }}"
                                    required
                                    aria-describedby="dateHelp">
                                <div id="dateHelp" class="form-text">Format : JJ/MM/AAAA (sélectionnez une date).</div>
                                @error('date_consultation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="type_acte" class="form-label fw-bold">Type d’acte</label>
                                <select
                                    class="form-select @error('type_acte') is-invalid @enderror"
                                    id="type_acte"
                                    name="type_acte"
                                    required>
                                    @php
                                        $types = ['Consultation générale','Examen de spécialité','Urgence'];
                                    @endphp
                                    <option value="">— Sélectionner —</option>
                                    @foreach($types as $t)
                                        <option value="{{ $t }}" @selected(old('type_acte')===$t)>{{ $t }}</option>
                                    @endforeach
                                </select>
                                @error('type_acte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="motif" class="form-label fw-bold">Motif de la consultation</label>
                            <textarea
                                class="form-control @error('motif') is-invalid @enderror"
                                id="motif"
                                name="motif"
                                rows="2"
                                placeholder="Ex : Douleur abdominale depuis 48 h…"
                                required>{{ old('motif') }}</textarea>
                            @error('motif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="diagnostic" class="form-label fw-bold">Diagnostic / Observations</label>
                            <textarea
                                class="form-control @error('diagnostic') is-invalid @enderror"
                                id="diagnostic"
                                name="diagnostic"
                                rows="3"
                                placeholder="Ex : Gastro-entérite ; examens sanguins en cours."
                                required>{{ old('diagnostic') }}</textarea>
                            @error('diagnostic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="prescription" class="form-label fw-bold">Prescription / Traitement</label>
                            <textarea
                                class="form-control @error('prescription') is-invalid @enderror"
                                id="prescription"
                                name="prescription"
                                rows="4"
                                placeholder="Ex : SRO 1 sachet 3×/j pendant 3 j ; Antalgique 1 cp matin et soir.">{{ old('prescription') }}</textarea>
                            @error('prescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Champs cachés utiles (ex: patient_id, médecin courant) --}}
                        @if(!empty($patient->id))
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        @endif
                        @auth
                            <input type="hidden" name="medecin_id" value="{{ auth()->id() }}">
                        @endauth

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-lg text-white" style="background-color:#005BAC; border-radius:50px;">
                                Enregistrer l’acte médical
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info : si l’image de fond n’existe pas --}}
            @if(!file_exists(public_path('images/fond-dossier.jpg')))
                <div class="alert alert-warning small">
                    Astuce : placez votre image de fond à <code>public/images/fond-dossier.jpg</code>
                    ou remplacez <code>asset('images/fond-dossier.jpg')</code> par votre chemin.
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
