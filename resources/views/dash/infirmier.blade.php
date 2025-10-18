@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="alert alert-success">
        <strong>Tableau de bord Infirmier</strong> — vous êtes connecté comme <code>{{ auth()->user()->role }}</code>.
    </div>
</div>
@endsection
