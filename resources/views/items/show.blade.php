@extends('layout.main')

@section('main')
    <h1>Items</h1>

    <a href="{{ route('items.index') }}">Retour à la liste</a>
    <a href="{{ route('items.create') }}">Créer un item</a>

    <ul>
        <li>id : {{ $item->id }}</li>
        <li>nom : {{ $item->name }}</li>
        <li>created_at : {{ $item->created_at }}</li>
        <li>updated_at : {{ $item->updated_at }}</li>
        <li>price : {{ $item->price/100 }}€</li>
        <li>cout : {{ $item->cost/100 }}€</li>
    </ul>
    
    <h2>Category : {{ $item->category->name }}</h2>

    <p>Aller à la category : <a href="{{ route('categories.show', $item->category->id) }}" title="Voir la category">{{ $item->category->name }}</a></p>

@endsection