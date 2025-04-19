@extends('layout.main')
@section('content')
<div class="container mt-4">
    <h1>Tableau de bord</h1>
    
    @if(auth()->check() && auth()->user()->role === 'admin')
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @else
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">Bienvenue sur ClickNeat</div>
                    <div class="card-body">
                        <h5 class="card-title">Bonjour {{ auth()->user()->prenom }} {{ auth()->user()->name }}</h5>
                        <p class="card-text">Vous êtes connecté en tant que {{ auth()->user()->role }}.</p>
                    </div>
                </div>
            </div>
        </div>
        
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
    @endif
</div>
@endsection