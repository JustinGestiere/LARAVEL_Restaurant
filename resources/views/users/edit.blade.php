@extends('layout.main')
@section('content')
<div class="container">
    <h2>Modifier un utilisateur</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" class="form-control" required>
                <option value="client" @if($user->role=='client') selected @endif>Client</option>
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                <option value="restaurateur" @if($user->role=='restaurateur') selected @endif>Restaurateur</option>
                <option value="employe" @if($user->role=='employe') selected @endif>Employé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
