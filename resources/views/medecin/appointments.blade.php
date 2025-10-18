@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="h3 mb-4">Mes rendez-vous</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @forelse ($rdvs as $r)
    @if ($loop->first)
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Patient</th>
              <th scope="col">Statut</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
    @endif

            <tr>
              <td>
                @php
                  // Protéger l’accès si scheduled_at est null / string
                  $dt = optional($r->scheduled_at instanceof \Carbon\Carbon ? $r->scheduled_at : \Carbon\Carbon::parse($r->scheduled_at ?? null))
                        ?->timezone(config('app.timezone'));
                @endphp
                {{ $dt?->format('d/m/Y H:i') ?? '—' }}
              </td>

              <td>{{ $r->patient->name ?? '—' }}</td>

              <td>
                @php
                  $status = strtolower($r->status ?? 'pending');
                  $badge = [
                    'confirmed' => 'bg-success',
                    'cancelled' => 'bg-danger',
                    'pending'   => 'bg-secondary',
                  ][$status] ?? 'bg-secondary';
                @endphp
                <span class="badge {{ $badge }}">{{ strtoupper($status) }}</span>
              </td>

              <td class="text-end">
                {{-- Confirmer --}}
                @if (($r->status ?? '') !== 'confirmed')
                  <form method="post"
                        action="{{ route('medecin.rdv.confirm', $r) }}"
                        class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">
                      Confirmer
                    </button>
                  </form>
                @endif

                {{-- Annuler --}}
                @if (($r->status ?? '') !== 'cancelled')
                  <form method="post"
                        action="{{ route('medecin.rdv.decline', $r) }}"
                        class="d-inline"
                        onsubmit="return confirm('Annuler ce rendez-vous ?');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      Annuler
                    </button>
                  </form>
                @endif
              </td>
            </tr>

    @if ($loop->last)
          </tbody>
        </table>
      </div>
    @endif

  @empty
    <div class="alert alert-info">
      Aucun rendez-vous pour le moment.
    </div>
  @endforelse

  <div class="mt-3">
    {{ $rdvs->links() }}
  </div>
</div>
@endsection
