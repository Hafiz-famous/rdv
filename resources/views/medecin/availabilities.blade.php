@extends('layouts.app')
@section('title','Médecin - Disponibilités')

@section('content')
<div class="container py-4">
  <h1 class="h3 mb-4">Définir mes disponibilités</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Veuillez corriger :</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('medecin.avail.store') }}" class="row g-3 col-md-6">
    @csrf

    <div class="col-12">
      <label class="form-label">Jour</label>
      <select name="weekday" class="form-select" required>
        @php
          $days = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
        @endphp
        @foreach ($days as $i => $day)
          <option value="{{ $i }}" @selected(old('weekday')==$i)>{{ $day }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-6">
      <label class="form-label">Début</label>
      <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
    </div>

    <div class="col-6">
      <label class="form-label">Fin</label>
      <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
    </div>

    <div class="col-12 form-check">
      <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" @checked(old('is_active'))>
      <label class="form-check-label" for="is_active">Actif</label>
    </div>

    <div class="col-12">
      <button class="btn btn-success">Ajouter</button>
    </div>
  </form>

  <h2 class="h5 mt-5 mb-3">Mes plages</h2>

  @if ($avail->isEmpty())
    <div class="alert alert-info">Aucune plage définie pour le moment.</div>
  @else
    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Jour</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Actif</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($avail as $a)
            <tr>
              <td>{{ $days[$a->weekday] ?? $a->weekday }}</td>
              <td>{{ \Illuminate\Support\Str::of($a->start_time)->substr(0,5) }}</td>
              <td>{{ \Illuminate\Support\Str::of($a->end_time)->substr(0,5) }}</td>
              <td>
                <span class="badge {{ $a->is_active ? 'bg-success' : 'bg-secondary' }}">
                  {{ $a->is_active ? 'Oui' : 'Non' }}
                </span>
              </td>
              <td class="text-end">
                {{-- Toggle actif/inactif --}}
                <form method="POST" action="{{ route('medecin.avail.toggle', $a) }}" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-sm btn-outline-primary">
                    {{ $a->is_active ? 'Désactiver' : 'Activer' }}
                  </button>
                </form>

                {{-- Supprimer --}}
                <form method="POST" action="{{ route('medecin.avail.destroy', $a) }}"
                      class="d-inline"
                      onsubmit="return confirm('Supprimer cette plage ?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
