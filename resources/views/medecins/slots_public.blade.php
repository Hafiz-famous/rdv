@extends('layouts.app')

@section('content')
<h1>Créneaux disponibles — {{ $medecin->name }}</h1>

<table class="table">
  <thead>
    <tr><th>Début</th><th>Fin</th><th></th></tr>
  </thead>
  <tbody>
  @foreach($slots as $s)
    <tr>
      <td>{{ $s->starts_at }}</td>
      <td>{{ $s->ends_at }}</td>
      <td>
        @auth
          @can('access-patient')
            <form method="post" action="{{ route('rdv.book.slot',$s) }}">
              @csrf
              <button type="submit">Réserver</button>
            </form>
          @endcan
        @else
          <a href="{{ route('login') }}">Connectez-vous pour réserver</a>
        @endauth
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{{ $slots->links() }}
@endsection
