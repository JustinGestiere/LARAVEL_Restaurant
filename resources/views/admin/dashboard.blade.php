@extends('layout.main')
@section('content')
<div class="container mt-4">
    <h1>Tableau de bord administrateur</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Clients</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbClients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Restaurateurs</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbRestaurateurs }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Employés</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbEmployes }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Admins</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbAdmins }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Restaurants</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbRestaurants }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Catégories</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbCategories }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Plats</div>
                <div class="card-body">
                    <h3 class="card-title">{{ $nbItems }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
