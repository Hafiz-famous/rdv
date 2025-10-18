@php
  use Illuminate\Support\Facades\Route;
  $isActive = fn(string $name) => request()->routeIs($name);
  $has      = fn(string $name) => Route::has($name);
@endphp

<h5 class="text-white mb-4">Espace Patient</h5>

<nav class="nav flex-column">
  {{-- Tableau de bord --}}
  <a
    class="nav-link {{ $isActive('patient.dashboard') ? 'active text-white' : 'text-white-75' }}"
    href="{{ $has('patient.dashboard') ? route('patient.dashboard') : '#' }}"
    {{ $isActive('patient.dashboard') ? 'aria-current=page' : '' }}
  >
    <i class="bi bi-speedometer2 me-2"></i>
    Tableau de bord
  </a>

  {{-- Prendre un rendez-vous (public) --}}
  <a
    class="nav-link {{ $isActive('medecins.index') ? 'active text-white' : 'text-white-75' }}"
    href="{{ $has('medecins.index') ? route('medecins.index') : '#' }}"
    {{ $isActive('medecins.index') ? 'aria-current=page' : '' }}
  >
    <i class="bi bi-calendar-plus me-2"></i>
    Prendre un rendez-vous
    @isset($upcomingCount)
      <span class="badge bg-light text-primary ms-2">{{ $upcomingCount }}</span>
    @endisset
  </a>

  {{-- Dossier médical --}}
  <a
    class="nav-link {{ $isActive('patient.dossier') ? 'active text-white' : 'text-white-75' }}"
    href="{{ $has('patient.dossier') ? route('patient.dossier') : '#' }}"
    {{ $isActive('patient.dossier') ? 'aria-current=page' : '' }}
  >
    <i class="bi bi-file-medical me-2"></i>
    Mon Dossier Médical
  </a>

  {{-- Profil --}}
  <a
    class="nav-link {{ $isActive('patient.profile') ? 'active text-white' : 'text-white-75' }}"
    href="{{ $has('patient.profile') ? route('patient.profile') : '#' }}"
    {{ $isActive('patient.profile') ? 'aria-current=page' : '' }}
  >
    <i class="bi bi-person-circle me-2"></i>
    Mon Profil
  </a>

  <hr class="text-white-50">

  {{-- Déconnexion --}}
  <a class="nav-link text-white-75" href="#"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="bi bi-box-arrow-right me-2"></i>
    Déconnexion
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</nav>
