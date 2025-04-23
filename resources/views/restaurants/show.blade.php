@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
    @if(Auth::check())

    @endif

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>ID :</strong> {{ $restaurant->id }}</li>
        <li class="list-group-item"><strong>Nom :</strong> {{ $restaurant->name }}</li>
        <li class="list-group-item"><strong>Créé le :</strong> {{ $restaurant->created_at }}</li>
        <li class="list-group-item"><strong>Mis à jour le :</strong> {{ $restaurant->updated_at }}</li>
    </ul>

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
