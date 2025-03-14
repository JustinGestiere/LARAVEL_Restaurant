@extends('layout.main')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Création d'un item</h1>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nom" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix :</label>
                <input type="number" id="price" name="price" class="form-control" placeholder="Prix en centimes" required>
            </div>

            <div class="mb-3">
                <label for="cost" class="form-label">Coût :</label>
                <input type="number" id="cost" name="cost" class="form-control" placeholder="Coût en centimes" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie :</label>
                <div class="input-group">
                    <span class=""><i class="bi bi-tags"></i></span>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
@endsection
