@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1>Laisser un avis pour {{ $restaurant->name }}</h1>
    <form action="{{ route('avis.store', $restaurant->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="note" class="form-label">Note (1 à 5)</label>
            <select class="form-select" id="note" name="note" required>
                <option value="">Choisir une note</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="avis" class="form-label">Votre avis</label>
            <textarea class="form-control" id="avis" name="avis" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
        <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
