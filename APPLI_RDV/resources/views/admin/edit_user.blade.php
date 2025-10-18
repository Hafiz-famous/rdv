@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4">Modifier l'utilisateur</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-control" required>
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                <option value="medecin" @if($user->role=='medecin') selected @endif>Médecin</option>
                <option value="patient" @if($user->role=='patient') selected @endif>Patient</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
