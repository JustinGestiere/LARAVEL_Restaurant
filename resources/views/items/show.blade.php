@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Détails de l'Item</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>

    <div class="card shadow-lg p-4 mb-4">
        <ul class="list-group">
            <li class="list-group-item"><strong>ID :</strong> {{ $item->id }}</li>
            <li class="list-group-item"><strong>Nom :</strong> {{ $item->name }}</li>
            <li class="list-group-item"><strong>Créé le :</strong> {{ $item->created_at }}</li>
            <li class="list-group-item"><strong>Mis à jour le :</strong> {{ $item->updated_at }}</li>
            <li class="list-group-item"><strong>Prix :</strong> {{ $item->price/100 }}€</li>
            <li class="list-group-item"><strong>Coût :</strong> {{ $item->cost/100 }}€</li>
        </ul>
    </div>

    <h2 class="mb-3">Catégorie : {{ $item->category->name }}</h2>

    <p>Aller à la catégorie : <a href="{{ route('categories.show', $item->category->id) }}" class="btn btn-link" title="Voir la catégorie">{{ $item->category->name }}</a></p>
</div>
@endsection
