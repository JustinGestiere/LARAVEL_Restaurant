{{--
    Page : restaurants/create.blade.php
    Description : Formulaire de création d'un restaurant (nom, restaurateurs, employés, etc).
--}}
@extends('layout.main')

@section('content')
<div class="container mt-5">
    {{-- Formulaire de création de restaurant --}}
    <h1 class="mb-4 text-primary">Créer un restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

        <form action="{{ route('restaurants.store') }}" method="POST">
        {{-- Champs du formulaire --}}
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom : </label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nom">
        </div>
        <div class="mb-3">
            <label for="restaurateurs" class="form-label">Restaurateurs (optionnel) :</label>
            <select name="restaurateurs[]" id="restaurateurs" class="form-control" multiple>
                @foreach($restaurateurs as $restaurateur)
                    <option value="{{ $restaurateur->id }}">{{ $restaurateur->name }} {{ $restaurateur->prenom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="employes" class="form-label">Employés (optionnel) :</label>
            <select name="employes[]" id="employes" class="form-control" multiple>
                @foreach($employes as $employe)
                    <option value="{{ $employe->id }}">{{ $employe->name }} {{ $employe->prenom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    {{-- Fin du formulaire --}}
</div>
@endsection
{{-- Fin du fichier --}}

