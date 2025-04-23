@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Détails de la catégorie</h1>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4 mb-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>id :</strong> {{ $category->id }}</li>
            <li class="list-group-item"><strong>Nom :</strong> {{ $category->name }}</li>
            <li class="list-group-item"><strong>Créé le :</strong> {{ $category->created_at }}</li>
            <li class="list-group-item"><strong>Mis à jour le :</strong> {{ $category->updated_at }}</li>
        </ul>
    </div>

    <h2 class="mt-4">Restaurant : {{ $category->restaurant->name }}</h2>
    
    <p>Aller au restaurant : 
        <a href="{{ route('restaurants.show', $category->restaurant->id) }}" class="btn btn-link" title="Voir le restaurant">{{ $category->restaurant->name }}</a>
    </p>
</div>
@endsection
