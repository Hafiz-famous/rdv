@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong>Créer un compte — {{ ucfirst($role) }}</strong>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store', $role) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresse e-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        {{-- Champs spécifiques (affichés selon le rôle) --}}
                        @if ($role === 'patient')
                            <div class="mb-3">
                                <label class="form-label">Numéro assuré (optionnel)</label>
                                <input type="text" name="numero_assure" class="form-control" value="{{ old('numero_assure') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date de naissance (optionnel)</label>
                                <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}">
                            </div>
                        @elseif ($role === 'medecin')
                            <div class="mb-3">
                                <label class="form-label">N° ordre (optionnel)</label>
                                <input type="text" name="numero_ordre" class="form-control" value="{{ old('numero_ordre') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Spécialité (optionnel)</label>
                                <input type="text" name="specialite" class="form-control" value="{{ old('specialite') }}">
                            </div>
                        @elseif ($role === 'infirmier')
                            <div class="mb-3">
                                <label class="form-label">N° badge (optionnel)</label>
                                <input type="text" name="numero_badge" class="form-control" value="{{ old('numero_badge') }}">
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Créer le compte</button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-muted small mt-3">
                Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
            </p>
        </div>
    </div>
</div>
@endsection
