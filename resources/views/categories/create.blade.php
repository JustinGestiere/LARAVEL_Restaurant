@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création catégorie</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Création catégorie</h1>
        
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
        
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" id="name" name="name" placeholder="Nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant :</label>
                <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                    <option value="">Choisir un restaurant</option>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    
    <!-- Ajout de Bootstrap JS pour une meilleure interactivité -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
