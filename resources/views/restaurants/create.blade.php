@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Créer un restaurant</h1>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom : </label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nom">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
