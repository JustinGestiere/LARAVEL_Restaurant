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

            <div class="mb-3">
                <label for="restaurateurs" class="form-label">Restaurateurs (optionnel) :</label>
                <select name="restaurateurs[]" id="restaurateurs" class="form-control" multiple>
                    @foreach($restaurateurs as $restaurateur)
                        <option value="{{ $restaurateur->id }}" {{ in_array($restaurateur->id, $selectedRestaurateurs) ? 'selected' : '' }}>
                            {{ $restaurateur->name }} {{ $restaurateur->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="employes" class="form-label">Employés (optionnel) :</label>
                <select name="employes[]" id="employes" class="form-control" multiple>
                    @foreach($employes as $employe)
                        <option value="{{ $employe->id }}" {{ in_array($employe->id, $selectedEmployes) ? 'selected' : '' }}>
                            {{ $employe->name }} {{ $employe->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>
</div>
@endsection
