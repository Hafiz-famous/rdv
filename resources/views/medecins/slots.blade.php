@extends('layouts.app')

@section('content')
<h1>Mes créneaux disponibles</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
  <div class="alert alert-danger">
    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<form method="post" action="{{ route('medecin.slots.store') }}" class="mb-3">
  @csrf
  <label>Début</label>
  <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}">
  <label>Fin</label>
  <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}">
  <button type="submit">Ajouter</button>
</form>

<table class="table">
  <thead>
    <tr><th>Début</th><th>Fin</th><th>Réservé ?</th><th></th></tr>
  </thead>
  <tbody>
  @foreach($slots as $s)
    <tr>
      <td>{{ $s->starts_at }}</td>
      <td>{{ $s->ends_at }}</td>
      <td>{{ $s->is_booked ? 'Oui' : 'Non' }}</td>
      <td>
        @if(!$s->is_booked && $s->starts_at->isFuture())
        <form method="post" action="{{ route('medecin.slots.destroy',$s) }}" onsubmit="return confirm('Supprimer ce créneau ?');">
          @csrf @method('DELETE')
          <button type="submit">Supprimer</button>
        </form>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{{ $slots->links() }}
@endsection
