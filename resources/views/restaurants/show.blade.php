@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'restaurateur' || Auth::user()->role == 'employe'))

    @endif

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>ID :</strong> {{ $restaurant->id }}</li>
        <li class="list-group-item"><strong>Nom :</strong> {{ $restaurant->name }}</li>
        <li class="list-group-item"><strong>Créé le :</strong> {{ $restaurant->created_at }}</li>
        <li class="list-group-item"><strong>Mis à jour le :</strong> {{ $restaurant->updated_at }}</li>
        <li class="list-group-item">
            <strong>Restaurateurs affiliés :</strong>
            <ul>
                @forelse($restaurant->restaurateurs as $restaurateur)
                    <li>{{ $restaurateur->name }} {{ $restaurateur->prenom }}</li>
                @empty
                    <li>Aucun restaurateur affilié</li>
                @endforelse
            </ul>
        </li>
        <li class="list-group-item">
            <strong>Employés affiliés :</strong>
            <ul>
                @forelse($restaurant->employes as $employe)
                    <li>{{ $employe->name }} {{ $employe->prenom }}</li>
                @empty
                    <li>Aucun employé affilié</li>
                @endforelse
            </ul>
        </li>
    </ul>

    <h2 class="mb-3">Salle / Tables</h2>
    <div class="row">
        @forelse($tables as $table)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $table->name }}</h5>
                        <p class="card-text">Places : {{ $table->seats }}</p>
                        @if($table->disponible)
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-danger">Occupée</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">Aucune table enregistrée pour ce restaurant.</div>
        @endforelse
    </div>

    <h2 class="mb-3">Catégories</h2>

    <ul class="list-group">
        @foreach($restaurant->categories as $category)
            <li class="list-group-item">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none" title="Voir la catégorie : {{ $category->name }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
