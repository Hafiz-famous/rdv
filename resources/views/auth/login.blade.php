@extends('layouts.app')
@section('title','Connexion')
@section('content')
<h1>Connexion</h1>
@if ($errors->any())
  <div class=\"alert alert-danger\">
    <ul class=\"mb-0\">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif
<form method=\"POST\" action=\"{{ route('login.submit') }}\" class=\"row g-3 col-md-6\">
  @csrf
  <div class=\"col-12\">
    <label class=\"form-label\">Email</label>
    <input type=\"email\" class=\"form-control\" name=\"email\" value=\"{{ old('email') }}\" required autofocus>
  </div>
  <div class=\"col-12\">
    <label class=\"form-label\">Mot de passe</label>
    <input type=\"password\" class=\"form-control\" name=\"password\" required>
  </div>
  <div class=\"col-12 form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" name=\"remember\" id=\"remember\">
    <label class=\"form-check-label\" for=\"remember\">Se souvenir de moi</label>
  </div>
  <div class=\"col-12\">
    <button class=\"btn btn-primary\">Se connecter</button>
  </div>
</form>
@endsection
