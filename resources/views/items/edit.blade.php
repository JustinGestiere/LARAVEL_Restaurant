{{--
    Page : items/edit.blade.php
    Description : Formulaire d'édition d'un item/plat existant (modification du nom, prix, catégorie, etc).
--}}
{{-- Section scripts éventuels --}}
@section('scripts')
@endsection

@extends('layout.main')

@section('content')
{{-- Formulaire d'édition d'item --}}
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Modification de l'Item</h1>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4">
        {{-- Formulaire --}}
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            {{-- Champs du formulaire --}}
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'item" value="{{ $item->name }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie :</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            @if($category->id == $item->category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix :</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Prix" value="{{ $item->price/100 }}" required>
            </div>

            <div class="mb-3">
                <label for="cost" class="form-label">Coût :</label>
                <input type="number" class="form-control" id="cost" name="cost" placeholder="Coût" value="{{ $item->cost/100 }}" required>
            </div>

            {{-- Bouton de validation --}}
            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    {{-- Fin du formulaire --}}
    </div>
</div>
@endsection
{{-- Fin du fichier --}}
