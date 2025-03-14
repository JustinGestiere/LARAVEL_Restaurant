@extends('layout.main')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Modification de l'Item</h1>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-4">
        <form action="{{ route('items.update', $item->id) }}" method="POST">
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

            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
@endsection
