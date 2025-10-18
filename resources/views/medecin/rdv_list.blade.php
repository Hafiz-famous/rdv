@extends('layouts.app')
@section('title','Médecin - Mes rendez-vous')

@section('content')
<div class="container py-4">
  <h1 class="h4 mb-4">Mes rendez-vous</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  {{-- Filtres --}}
  <form method="GET" class="row g-2 align-items-end mb-3">
    <div class="col-md-3">
      <label class="form-label">Statut</label>
      <select name="status" class="form-select">
        @php $st = request('status'); @endphp
        <option value="">Tous</option>
        <option value="pending"   @selected($st==='pending')>En attente</option>
        <option value="confirmed" @selected($st==='confirmed')>Confirmé</option>
        <option value="cancelled" @selected($st==='cancelled')>Annulé</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">À partir du</label>
      <input type="date" name="from" value="{{ request('from') }}" class="form-control">
    </div>
    <div class="col-md-3">
      <label class="form-label">Jusqu’au</label>
      <input type="date" name="to" value="{{ request('to') }}" class="form-control">
    </div>
    <div class="col-md-3">
      <button class="btn btn-primary">Filtrer</button>
      <a href="{{ route('medecin.rdv.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
    </div>
  </form>

  @if($rdvs->isEmpty())
    <div class="alert alert-info">Aucun rendez-vous pour l’instant.</div>
  @else
    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Date & heure</th>
            <th>Patient</th>
            <th>Motif</th>
            <th>Statut</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($rdvs as $r)
          <tr>
            <td>{{ $r->scheduled_at->format('d/m/Y H:i') }}</td>
            <td>{{ $r->patient?->name ?? '—' }}</td>
            <td>{{ $r->reason ?? '—' }}</td>
            <td>
              @php
                $badges = ['pending'=>'warning','confirmed'=>'success','cancelled'=>'secondary'];
              @endphp
              <span class="badge bg-{{ $badges[$r->status] ?? 'secondary' }}">
                {{ ucfirst($r->status) }}
              </span>
            </td>
            <td class="text-end">
              @if($r->status !== 'confirmed')
                <form method="POST" action="{{ route('medecin.rdv.confirm', $r) }}" class="d-inline">
                  @csrf
                  <button class="btn btn-sm btn-outline-success">Confirmer</button>
                </form>
              @endif
              @if($r->status !== 'cancelled')
                <form method="POST" action="{{ route('medecin.rdv.decline', $r) }}"
                      class="d-inline"
                      onsubmit="return confirm('Annuler ce rendez-vous ?');">
                  @csrf
                  <button class="btn btn-sm btn-outline-danger">Annuler</button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $rdvs->withQueryString()->links() }}
    </div>
  @endif
</div>
@endsection
