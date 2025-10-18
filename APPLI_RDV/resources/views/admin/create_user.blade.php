@extends('layouts.app')
@section('title','Ajouter un utilisateur')

@section('content')
<div class="container py-4">
  <div class="d-flex align-items-center mb-3">
    <h2 class="mb-0">Ajouter un utilisateur</h2>
    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary ms-auto">
      <i class="bi bi-chevron-left me-1"></i> Retour à la liste
    </a>
  </div>

  {{-- Erreurs globales --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Veuillez corriger les erreurs suivantes :</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('admin.users.store') }}" method="POST" class="card p-4 shadow-sm border-0">
    @csrf

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nom *</label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Email *</label>
        <input type="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Mot de passe *</label>
        <div class="input-group">
          <input id="password" type="password" name="password"
                 class="form-control @error('password') is-invalid @enderror" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePwd">
            <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-outline-secondary" type="button" id="genPwd">
            Générer
          </button>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="form-text">8 caractères minimum.</div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Confirmer le mot de passe *</label>
        <input type="password" name="password_confirmation"
               class="form-control" required>
      </div>

      <div class="col-12">
        <label class="form-label d-block">Rôle *</label>
        <div class="btn-group" role="group" aria-label="Choix du rôle">
          @php $roleOld = old('role','patient'); @endphp
          <input type="radio" class="btn-check" name="role" id="rolePatient" value="patient" {{ $roleOld==='patient'?'checked':'' }}>
          <label class="btn btn-outline-primary" for="rolePatient">Patient</label>

          <input type="radio" class="btn-check" name="role" id="roleMedecin" value="medecin" {{ $roleOld==='medecin'?'checked':'' }}>
          <label class="btn btn-outline-primary" for="roleMedecin">Médecin</label>

          <input type="radio" class="btn-check" name="role" id="roleAdmin" value="admin" {{ $roleOld==='admin'?'checked':'' }}>
          <label class="btn btn-outline-primary" for="roleAdmin">Admin</label>
        </div>
        @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-check2-circle me-1"></i> Créer
      </button>
      <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Annuler</a>
    </div>
  </form>
</div>

@push('scripts')
<script>
  const toggleBtn = document.getElementById('togglePwd');
  const pwdInput  = document.getElementById('password');
  const genBtn    = document.getElementById('genPwd');

  toggleBtn?.addEventListener('click', () => {
    const isPwd = pwdInput.type === 'password';
    pwdInput.type = isPwd ? 'text' : 'password';
    toggleBtn.firstElementChild.className = isPwd ? 'bi bi-eye-slash' : 'bi bi-eye';
  });

  genBtn?.addEventListener('click', () => {
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789!@#$%';
    let out = '';
    for (let i=0;i<12;i++) out += chars[Math.floor(Math.random()*chars.length)];
    pwdInput.value = out;
    // On remplit la confirmation si elle existe.
    document.querySelector('input[name="password_confirmation"]')?.value = out;
  });
</script>
@endpush
@endsection
