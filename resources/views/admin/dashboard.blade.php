@extends('layouts.app')
@section('title','Admin - Dashboard')
@section('content')
<h1>Dashboard Admin</h1>
<div class=\"row g-3\">
  <div class=\"col-md-3\"><div class=\"p-3 bg-light border rounded\">RDV aujourd'hui: <strong>0</strong></div></div>
  <div class=\"col-md-3\"><div class=\"p-3 bg-light border rounded\">Médecins actifs: <strong>0</strong></div></div>
  <div class=\"col-md-3\"><div class=\"p-3 bg-light border rounded\">Patients: <strong>0</strong></div></div>
  <div class=\"col-md-3\"><div class=\"p-3 bg-light border rounded\">Taux annulation: <strong>0%</strong></div></div>
</div>
@endsection
