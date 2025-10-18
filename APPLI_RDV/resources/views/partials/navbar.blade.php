{{-- Dropdown Se connecter --}}
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Se connecter
  </a>
  <ul class="dropdown-menu" aria-labelledby="loginDropdown">
    <li>
      <a class="dropdown-item" href="{{ route('login', ['role' => 'patient']) }}">
        Se connecter en tant que patient
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('login', ['role' => 'medecin']) }}">
        Se connecter en tant que médecin
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
      <a class="dropdown-item" href="{{ route('cabinets.login.show') }}">
        Se connecter en tant que cabinet
      </a>
    </li>
  </ul>
</li>
