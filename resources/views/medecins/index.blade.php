@extends('layouts.public')
@section('title','Médecins')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="mb-0">Médecins</h1>
      <small class="text-muted">Trouvez le professionnel qui vous convient</small>
    </div>
  </div>

  {{-- Filtres --}}
  <form method="GET" class="row g-2 align-items-end mb-4">
    <div class="col-md-4">
      <label class="form-label">Spécialité</label>
      <select name="specialty" class="form-select" onchange="this.form.submit()">
        <option value="">Toutes les spécialités</option>
        @foreach(($specialties ?? []) as $s)
          <option value="{{ $s->slug }}"
            @selected(request('specialty') === $s->slug)>{{ $s->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-5">
      <label class="form-label">Recherche</label>
      <input type="text" name="q" class="form-control"
             value="{{ request('q') }}"
             placeholder="Nom du médecin, hôpital, ville…">
    </div>

    <div class="col-md-3 d-grid">
      <button class="btn btn-primary"><i class="bi bi-search me-1"></i> Rechercher</button>
      @if(request()->hasAny(['specialty','q']) && (request('specialty') || request('q')))
        <a href="{{ route('medecins.index') }}" class="btn btn-outline-secondary mt-2">
          Réinitialiser
        </a>
      @endif
    </div>
  </form>

  {{-- Résultats --}}
  @if(($medecins ?? collect())->count())
    <div class="row g-3">
      @foreach($medecins as $m)
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              @php
                $showUrl = \Illuminate\Support\Facades\Route::has('medecins.show')
                  ? route('medecins.show', $m)
                  : '#';
              @endphp

              <h5 class="card-title mb-1">
                <a class="text-decoration-none" href="{{ $showUrl }}">
                  {{ $m->name ?? 'Médecin' }}
                </a>
              </h5>

              <div class="text-muted mb-2">
                {{ $m->city ?? '' }} {{ isset($m->facility) ? '· '.$m->facility : '' }}
              </div>

              {{-- Spécialités en badges --}}
              @php $specs = ($m->specialties ?? collect())->pluck('name'); @endphp
              @if($specs->count())
                <div class="mb-2">
                  @foreach($specs as $sp)
                    <span class="badge bg-primary-subtle border border-primary-subtle text-primary me-1 mb-1">{{ $sp }}</span>
                  @endforeach
                </div>
              @endif

              {{-- Accroche courte si dispo --}}
              @if(!empty($m->tagline))
                <p class="small text-muted mb-0">{{ $m->tagline }}</p>
              @endif
            </div>

            <div class="card-footer bg-white border-0 d-flex justify-content-between">
              <a href="{{ $showUrl }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-person-vcard me-1"></i> Voir le profil
              </a>

              @if(Route::has('rendezvous.create'))
                <a href="{{ route('rendezvous.create', ['medecin' => $m->id ?? null]) }}"
                   class="btn btn-sm btn-primary">
                  <i class="bi bi-calendar-plus me-1"></i> Prendre RDV
                </a>
              @else
                <a href="{{ route('login', ['role'=>'patient']) }}" class="btn btn-sm btn-primary">
                  <i class="bi bi-calendar-plus me-1"></i> Prendre RDV
                </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $medecins->withQueryString()->links() }}
    </div>
  @else
    <div class="alert alert-info">
      Aucun médecin trouvé @if(request('specialty') || request('q')) pour ces critères @endif.
      Essayez d’autres mots-clés ou retirez des filtres.
    </div>
  @endif
@endsection
