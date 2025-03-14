@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Modification du restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom du restaurant" value="{{ $restaurant->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
