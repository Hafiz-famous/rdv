@extends('layouts.app')
@section('title','Mes rendez-vous')
@section('content')
<h1>Mes rendez-vous</h1>
<table class=\"table\">
  <thead><tr><th>Date</th><th>Début</th><th>Fin</th><th>Statut</th></tr></thead>
  <tbody>
  @forelse ($items as $rdv)
    <tr>
      <td>{{ $rdv->date }}</td>
      <td>{{ $rdv->start_time }}</td>
      <td>{{ $rdv->end_time }}</td>
      <td>{{ $rdv->status }}</td>
    </tr>
  @empty
    <tr><td colspan=\"4\">Aucun RDV</td></tr>
  @endforelse
  </tbody>
</table>
{{ $items->links() }}
@endsection
