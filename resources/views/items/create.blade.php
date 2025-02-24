<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation category</title>
</head>
<body>
    <h1>Creation item</h1>

    <a href="{{ route('items.index') }}">Retour à la liste</a>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom : </label>
            <input type="text" id="name" name="name" placeholder="Nom" required>
        </div>
        <div>
            <label for="item_id">Prix : </label>
            <input type="number" id="price" name="price" placeholder="Prix" required>
        </div>
        <div>
            <label for="item_id">Coût : </label>
            <input type="number" id="cost" name="cost" placeholder="Cout" required>
        </div>
        <div>
            <label for="category_id">Catégorie : </label>
            <select name="category_id" id="category_id" required>
                <option value="">Choisir une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Envoyer</button>
    </form>

</body>
</html>