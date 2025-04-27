@extends('layout.main')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Ajouter une table</h1>
    <a href="{{ route('tables.index') }}" class="btn btn-secondary mb-3">Retour</a>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom de la table</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="seats" class="form-label">Nombre de places</label>
            <input type="number" name="seats" id="seats" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">Sélectionner un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
