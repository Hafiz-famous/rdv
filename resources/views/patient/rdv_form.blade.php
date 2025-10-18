@extends('layouts.app')
@section('title','Prendre un rendez-vous')
@section('content')
<h1>Prendre un RDV — Médecin #{{ $doctorId }}</h1>
@if ($errors->any())
  <div class=\"alert alert-danger\">
    <ul class=\"mb-0\">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif
<form method=\"POST\" action=\"{{ route('rdv.book', $doctorId) }}\" class=\"row g-3 col-md-6\">
  @csrf
  <div class=\"col-12\">
    <label class=\"form-label\">Date</label>
    <input type=\"date\" name=\"date\" class=\"form-control\" value=\"{{ old('date') }}\" required>
  </div>
  <div class=\"col-6\">
    <label class=\"form-label\">Heure début</label>
    <input type=\"time\" name=\"start_time\" class=\"form-control\" value=\"{{ old('start_time') }}\" required>
  </div>
  <div class=\"col-6\">
    <label class=\"form-label\">Heure fin</label>
    <input type=\"time\" name=\"end_time\" class=\"form-control\" value=\"{{ old('end_time') }}\" required>
  </div>
  <div class=\"col-12\">
    <label class=\"form-label\">Notes</label>
    <textarea name=\"notes\" class=\"form-control\" rows=\"3\">{{ old('notes') }}</textarea>
  </div>
  <div class=\"col-12\">
    <button class=\"btn btn-success\">Réserver</button>
  </div>
</form>
@endsection
