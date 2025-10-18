@extends('layouts.app')
@section('title','Inscription patient')
@section('content')
<h1>Créer un compte patient</h1>
@if ($errors->any())
  <div class=\"alert alert-danger\">
    <ul class=\"mb-0\">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif
<form method=\"POST\" action=\"{{ route('register.patient.submit') }}\" class=\"row g-3 col-md-8\">
  @csrf
  <div class=\"col-md-6\">
    <label class=\"form-label\">Nom complet</label>
    <input type=\"text\" class=\"form-control\" name=\"name\" value=\"{{ old('name') }}\">
    <div class=\"form-text\">Ou utilisez Prénom + Nom ci-dessous.</div>
  </div>
  <div class=\"col-md-3\">
    <label class=\"form-label\">Prénom</label>
    <input type=\"text\" class=\"form-control\" name=\"first_name\" value=\"{{ old('first_name') }}\">
  </div>
  <div class=\"col-md-3\">
    <label class=\"form-label\">Nom</label>
    <input type=\"text\" class=\"form-control\" name=\"last_name\" value=\"{{ old('last_name') }}\">
  </div>
  <div class=\"col-md-6\">
    <label class=\"form-label\">Email</label>
    <input type=\"email\" class=\"form-control\" name=\"email\" value=\"{{ old('email') }}\" required>
  </div>
  <div class=\"col-md-3\">
    <label class=\"form-label\">Mot de passe</label>
    <input type=\"password\" class=\"form-control\" name=\"password\" required>
  </div>
  <div class=\"col-md-3\">
    <label class=\"form-label\">Confirmer le mot de passe</label>
    <input type=\"password\" class=\"form-control\" name=\"password_confirmation\" required>
  </div>
  <div class=\"col-12\">
    <button class=\"btn btn-success\">Créer mon compte</button>
  </div>
</form>
@endsection
