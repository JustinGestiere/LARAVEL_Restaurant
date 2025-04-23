@extends('layout.main')
@php
    use Illuminate\Support\Str;
@endphp
@section('content')

<div class="container mt-4">
    <h1>Tableau de bord</h1>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Bienvenue sur ClickNeat</div>
                <div class="card-body">
                    <h5 class="card-title">Bonjour {{ auth()->user()->prenom }} {{ auth()->user()->name }}</h5>
                    <p class="card-text">Vous êtes connecté en tant que {{ auth()->user()->role }}.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques (masquées pour les clients) -->
    @if(Str::lower(trim(auth()->user()->role)) !== 'client')
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h1 class="card-title text-primary">{{ $stats['restaurants'] }}</h1>
                    <p class="card-text">Restaurants</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h1 class="card-title text-success">{{ $stats['categories'] }}</h1>
                    <p class="card-text">Catégories</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-info">
                <div class="card-body text-center">
                    <h1 class="card-title text-info">{{ $stats['items'] }}</h1>
                    <p class="card-text">Items</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <h1 class="card-title text-danger">{{ $stats['users'] }}</h1>
                    <p class="card-text">Utilisateurs</p>
                </div>
            </div>
        </div>
    </div>
    @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Restaurants</div>
                    <div class="card-body">
                        <p class="card-text">Découvrez nos restaurants partenaires.</p>
                        <a href="{{ route('restaurants.index') }}" class="btn btn-primary">Voir les restaurants</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Profil</div>
                    <div class="card-body">
                        <p class="card-text">Gérez vos informations personnelles.</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Modifier mon profil</a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection