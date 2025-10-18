@extends('layouts.app')

@section('content')
<h1>Prendre rendez-vous avec {{ $medecin->name }}</h1>

<form method="post" action="{{ route('rdv.store',$medecin) }}">
  @csrf
  <div style="margin-bottom:10px;">
    <label>Date & heure</label><br>
    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}">
    @error('scheduled_at') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div style="margin-bottom:10px;">
    <label>Durée (minutes)</label><br>
    <input type="number" name="duration_minutes" value="{{ old('duration_minutes',20) }}" min="10" max="120">
  </div>

  <div style="margin-bottom:10px;">
    <label>Motif</label><br>
    <input type="text" name="motif" value="{{ old('motif') }}">
  </div>

  <button type="submit">Confirmer</button>
</form>
@endsection
