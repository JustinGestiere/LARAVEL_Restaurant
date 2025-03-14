@extends('layout.main')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Modification du Restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4">
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom du restaurant" value="{{ $restaurant->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
@endsection
