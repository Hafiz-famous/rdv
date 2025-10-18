@extends('layouts.app')

@section('title', 'Tableau de bord — Patient')

{{-- Barre latérale spécifique patient --}}
@section('sidebar')
    @includeWhen(View::exists('partials.sidebar-patient'), 'partials.sidebar-patient')
@endsection

@push('styles')
<style>
    .card-kpi .icon {
        width: 42px; height: 42px; display: grid; place-items: center;
        border-radius: .5rem; background: rgba(0,91,172,.08);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Entête --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h4 mb-1">Bonjour, {{ auth()->user()->name ?? 'Cher patient' }}</h1>
            <div class="text-muted">Voici un aperçu de votre espace santé.</div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-primary btn-sm"
               href="{{ Route::has('rendezvous.create') ? route('rendezvous.create') : route('medecins.index') }}">
                <i class="bi bi-calendar-plus me-1"></i> Prendre un rendez-vous
            </a>
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('patient.profile') }}">
                <i class="bi bi-person-gear me-1"></i> Mon profil
            </a>
        </div>
    </div>

    {{-- Lignes d’alertes globales --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- KPIs --}}
    <div class="row g-4 mb-2">
        {{-- Prochain rendez-vous --}}
        <div class="col-md-4">
            <div class="card card-kpi shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon text-primary">
                            <i class="bi bi-calendar-check fs-5"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 text-primary">Prochain rendez-vous</h5>
                            @php
                                $rdv = $nextAppointment ?? null;
                            @endphp
                            @if($rdv)
                                <div class="fw-semibold">
                                    Dr {{ $rdv->doctor_name ?? '—' }}
                                </div>
                                <div class="text-muted">
                                    {{ \Carbon\Carbon::parse($rdv->scheduled_at)->translatedFormat('dddd D MMMM YYYY à HH[h]mm') }}
                                </div>
                                <div class="mt-2">
                                    @if (Route::has('rendezvous.show'))
                                        <a class="btn btn-outline-primary btn-sm"
                                           href="{{ route('rendezvous.show', $rdv->id) }}">
                                           Détails
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="text-muted">Aucun rendez-vous planifié</div>
                                <div class="mt-2">
                                    <a class="btn btn-outline-primary btn-sm"
                                       href="{{ Route::has('rendezvous.create') ? route('rendezvous.create') : route('medecins.index') }}">
                                        Planifier
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dossier médical --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon text-success" style="background: rgba(25,135,84,.12)">
                            <i class="bi bi-file-medical-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 text-success">Dossier médical</h5>
                            <div class="fw-semibold fs-5">
                                {{ $stats['consultations'] ?? 0 }} consultation(s)
                            </div>
                            <div class="text-muted">
                                Dernière mise à jour :
                                {{ isset($stats['last_update'])
                                    ? \Carbon\Carbon::parse($stats['last_update'])->format('d/m/Y')
                                    : '—' }}
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('patient.dossier') }}" class="btn btn-outline-success btn-sm">
                                    Consulter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trouver une spécialité --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="background: rgba(13,110,253,.06)">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon text-info" style="background: rgba(13,110,253,.12)">
                            <i class="bi bi-heart-pulse fs-5"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 text-info">Besoin urgent ?</h5>
                            <div class="fw-semibold">Trouver une spécialité</div>
                            <div class="text-muted">Accédez rapidement au répertoire des médecins.</div>
                            <div class="mt-2">
                                <a href="{{ route('specialites.index') }}" class="btn btn-info btn-sm text-white">
                                    Rechercher
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mes prochains rendez-vous --}}
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span class="fw-semibold">Mes prochains rendez-vous</span>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ url()->current() }}" class="d-none d-md-flex">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="form-control" placeholder="Rechercher (médecin, motif…)">
                    </div>
                </form>
                <a class="btn btn-sm btn-outline-primary"
                   href="{{ Route::has('rendezvous.create') ? route('rendezvous.create') : route('medecins.index') }}">
                    <i class="bi bi-plus-lg me-1"></i> Nouveau
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @php $items = $rendezvous ?? collect(); @endphp
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date & heure</th>
                            <th>Médecin</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $r)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($r->scheduled_at)->format('d/m/Y H:i') }}</td>
                            <td>Dr {{ $r->doctor_name ?? '—' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($r->reason ?? '—', 70) }}</td>
                            <td>
                                @php
                                    $map = [
                                        'pending' => ['warning','En attente'],
                                        'confirmed' => ['info','Confirmé'],
                                        'done' => ['success','Terminé'],
                                        'canceled' => ['danger','Annulé'],
                                    ];
                                    [$variant,$label] = $map[$r->status ?? 'pending'] ?? ['secondary','—'];
                                @endphp
                                <span class="badge text-bg-{{ $variant }}">{{ $label }}</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    @if (Route::has('rendezvous.show'))
                                        <a class="btn btn-outline-secondary"
                                           href="{{ route('rendezvous.show', $r->id) }}">
                                           Voir
                                        </a>
                                    @endif
                                    @if (Route::has('rendezvous.edit'))
                                        <a class="btn btn-outline-primary"
                                           href="{{ route('rendezvous.edit', $r->id) }}">
                                           Modifier
                                        </a>
                                    @endif
                                    @if (Route::has('rendezvous.destroy'))
                                        <form method="POST" action="{{ route('rendezvous.destroy', $r->id) }}"
                                              onsubmit="return confirm('Annuler ce rendez-vous ?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger">Annuler</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Aucun rendez-vous à venir.
                                <a href="{{ Route::has('rendezvous.create') ? route('rendezvous.create') : route('medecins.index') }}"
                                   class="text-decoration-none ms-1">Prendre un rendez-vous</a>.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($rendezvous) && method_exists($rendezvous, 'links'))
            <div class="card-footer">
                {{ $rendezvous->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
{{-- Scripts spécifiques si besoin --}}
@endpush
