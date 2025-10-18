@php
  $role = $role ?? request('role','patient'); // patient|medecin|infirmier|admin
@endphp

<div class="card shadow-sm border-0">
  <div class="card-body p-4">
    <h1 class="h4 mb-3">Connexion</h1>
    <p class="text-muted mb-4">
      Vous vous connectez en tant que
      <span class="badge bg-primary">{{ ucfirst($role) }}</span>
    </p>

    {{-- Onglets rôle --}}
    <ul class="nav nav-pills nav-justified mb-4">
      <li class="nav-item">
        <a class="nav-link {{ $role==='patient' ? 'active' : '' }}" href="{{ route('login',['role'=>'patient']) }}">
          Patient
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $role==='medecin' ? 'active' : '' }}" href="{{ route('login',['role'=>'medecin']) }}">
          Médecin
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $role==='infirmier' ? 'active' : '' }}" href="{{ route('login',['role'=>'infirmier']) }}">
          Infirmier
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $role==='admin' ? 'active' : '' }}" href="{{ route('login',['role'=>'admin']) }}">
          Admin / Cabinet
        </a>
      </li>
    </ul>

    {{-- Messages globaux --}}
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" novalidate>
      @csrf
      <input type="hidden" name="role" value="{{ $role }}">

      <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input id="email" name="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="password">Mot de passe</label>
        <div class="input-group">
          <input id="password" name="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 required>
          <button class="btn btn-outline-secondary" type="button" id="togglePwd">
            <i class="bi bi-eye"></i>
          </button>
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="d-flex justify-content-end mt-2">
          <a href="{{ url('/password/forgot') }}" class="small text-decoration-none">Mot de passe oublié ?</a>
        </div>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
      </div>

      <button class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
      </button>
    </form>

    <hr class="my-4">
    <div class="text-center small">
      Pas encore de compte ?
      <a href="{{ route('register.patient') }}" class="text-decoration-none">Créer un compte patient</a>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.getElementById('togglePwd')?.addEventListener('click', function(){
    const input = document.getElementById('password');
    const isPwd = input.type === 'password';
    input.type = isPwd ? 'text' : 'password';
    this.firstElementChild.className = isPwd ? 'bi bi-eye-slash' : 'bi bi-eye';
  });
</script>
@endpush
