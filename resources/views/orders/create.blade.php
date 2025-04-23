@extends('layout.main')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Nouvelle commande</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">Sélectionner un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="items" class="form-label">Items</label>
            <select name="items[]" id="items" class="form-select" multiple required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} ({{ number_format($item->price / 100, 2) }} €)</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantities" class="form-label">Quantités (dans l'ordre des items sélectionnés)</label>
            <input type="text" name="quantities[]" class="form-control" placeholder="Ex: 2,1,3" required>
            <small class="form-text text-muted">Séparez les quantités par des virgules, dans le même ordre que les items sélectionnés.</small>
        </div>
        <button type="submit" class="btn btn-primary">Valider la commande</button>
    </form>
</div>
@endsection
