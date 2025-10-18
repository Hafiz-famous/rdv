@extends('layouts.app')
@section('title','Tableau de bord patient')
@section('content')
<h1>Bienvenue sur votre tableau de bord</h1>
<p>Vos prochains rendez-vous apparaîtront ici.</p>
<a href=\"{{ route('patient.rdv') }}\" class=\"btn btn-primary\">Mes rendez-vous</a>
@endsection
