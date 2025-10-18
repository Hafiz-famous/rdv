@extends('layouts.app')

@section('content')
<h1>{{ $medecin->name }}</h1>
<p>Spécialités : {{ $medecin->specialties->pluck('name')->implode(', ') }}</p>
@if($medecin->doctorProfile)
  <p>Cabinet : {{ $medecin->doctorProfile->cabinet }} | Tél : {{ $medecin->doctorProfile->phone }}</p>
@endif
@auth
  @can('access-patient')
    <a href="{{ route('rdv.create',$medecin) }}" class="btn btn-primary">Prendre rendez-vous</a>
  @endcan
@endauth
@endsection
