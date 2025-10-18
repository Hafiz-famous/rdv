@extends('layouts.app')


@section('title', 'Nos Médecins Partenaires')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
<style>
    body { background-color:#f8f9fa; }
    .page-header { background:#004a88; color:#fff; padding:60px 0; }
    .brand { font-family:'Pacifico', cursive; }
    .medecin-card { transition: transform .2s ease, box-shadow .2s ease; }
    .medecin-card:hover { transform: translateY(-4px); box-shadow:0 8px 20px rgba(0,0,0,.12); }
</style>
@endpush

@section('content')
<header class="page-header text-center">
    <div class="container">
        <h1 class="display-5 fw-semibold">Nos Médecins Partenaires</h1>
        <p class="lead mb-0">Trouvez le professionnel de santé qui vous convient.</p>
    </div>
</header>

<main class="container py-5">
    {{-- Barre de recherche --}}
    <form method="GET" action="{{ route('medecins.index') }}" class="row justify-content-center mb-4 g-2">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-lg"
                   placeholder="Nom ou spécialité (ex: Kossi, cardiologie)" aria-label="Rechercher un médecin">
        </div>
        <div class="col-md-3">
            <input type="text" name="ville" value="{{ request('ville') }}" class="form-control form-control-lg"
                   placeholder="Ville (ex: Lomé)" aria-label="Ville">
        </div>
        <div class="col-md-3">
            <select name="assurance" class="form-select form-select-lg" aria-label="Assurance">
                <option value="">Assurance (toutes)</option>
                @foreach(($assurances ?? []) as $ass)
                    <option value="{{ $ass }}" @selected(request('assurance')===$ass)>{{ $ass }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary btn-lg"><i class="bi bi-search me-1"></i> Rechercher</button>
        </div>
        @if(request()->hasAny(['q','ville','assurance']))
            <div class="col-12 text-center mt-2">
                <a href="{{ route('medecins.index') }}" class="small text-decoration-none"><i class="bi bi-x-circle me-1"></i>Réinitialiser</a>
            </div>
        @endif
    </form>

    {{-- Résumé filtre / nombre de résultats --}}
    @isset($medecins)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="text-muted small">
                @if(method_exists($medecins, 'total'))
                    {{ $medecins->total() }} résultat(s)
                @else
                    {{ count($medecins) }} résultat(s)
                @endif
                @if(request('q')) • “{{ request('q') }}” @endif
                @if(request('ville')) • {{ request('ville') }} @endif
                @if(request('assurance')) • {{ request('assurance') }} @endif
            </div>
        </div>
    @endisset

    {{-- Grille des médecins --}}
    <div class="row g-4">
        @forelse($medecins ?? [] as $medecin)
            <div class="col-md-6 col-lg-4">
                <div class="card medecin-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        @php
                            $avatar = $medecin->photo_url
                                ?? "https://ui-avatars.com/api/?name=".urlencode("Dr ".$medecin->nom)."&background=0D8ABC&color=fff&size=100";
                        @endphp
                        <img src="{{ $avatar }}" alt="Photo de {{ 'Dr '.$medecin->nom }}" class="rounded-circle mb-3" width="96" height="96" loading="lazy">
                        <h5 class="card-title fw-semibold mb-1">Dr {{ $medecin->nom }}</h5>
                        <p class="card-subtitle text-muted mb-2">{{ $medecin->specialite ?? 'Médecin généraliste' }}</p>
                        <p class="small mb-1">
                            <i class="bi bi-hospital me-1"></i>
                            {{ $medecin->centre_sante ?? '—' }}
                        </p>
                        <p class="small text-muted mb-0">
                            <i class="bi bi-geo-alt me-1"></i>{{ $medecin->ville ?? '—' }}
                            @if(!empty($medecin->assurances))
                                • <i class="bi bi-shield-check ms-2 me-1"></i>
                                {{ is_array($medecin->assurances) ? implode(', ', $medecin->assurances) : $medecin->assurances }}
                            @endif
                        </p>
                        <div class="d-grid mt-3">
                            <a href="{{ Route::has('rendezvous.create') ? route('rendezvous.create', ['medecin'=>$medecin->id]) : '#' }}"
                               class="btn btn-outline-primary">
                                <i class="bi bi-calendar-plus me-1"></i> Prendre RDV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- État vide --}}
            <div class="col-12">
                <div class="text-center py-5 bg-white border rounded">
                    <i class="bi bi-search fs-1 text-muted d-block mb-2"></i>
                    <h5>Aucun médecin trouvé</h5>
                    <p class="text-muted mb-3">Essayez d’élargir votre recherche (nom, spécialité, ville, assurance).</p>
                    <a href="{{ route('medecins.index') }}" class="btn btn-primary">Tout afficher</a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(isset($medecins) && method_exists($medecins, 'links'))
        <div class="mt-4">
            {{ $medecins->withQueryString()->links() }}
        </div>
    @endif
</main>
@endsection
