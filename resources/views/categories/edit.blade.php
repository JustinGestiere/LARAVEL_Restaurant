@extends('layout.main')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Modification de catégorie</h1>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4">
        <form action="{{ route('categories.update', $category->id ) }}" method="POST">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nom" value="{{ $category->name }}" required>
            </div>

            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant :</label>
                <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}" @if($restaurant->id == $category->restaurant->id) selected @endif>{{ $restaurant->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
@endsection
