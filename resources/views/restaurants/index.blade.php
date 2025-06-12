{{--
    Page : restaurants/index.blade.php
    Description : Liste des restaurants avec options de création, modification, suppression et affichage des restaurateurs/employés.
--}}
@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Restaurants</h1>

    @auth
    @if(Str::lower(trim(Auth::user()->role)) !== 'client')
        <a href="{{ route('restaurants.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Créer un restaurant
        </a>
    @endif
@endauth

        {{-- Tableau des restaurants --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Restaurateurs</th>
                    <th>Employés</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>
                            @foreach($restaurant->restaurateurs as $restaurateur)
                                <span class="badge bg-primary">{{ $restaurateur->name }} {{ $restaurateur->prenom }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($restaurant->employes as $employe)
                                <span class="badge bg-secondary">{{ $employe->name }} {{ $employe->prenom }}</span>
                            @endforeach
                        </td>
                        <td>
                                                            {{-- Actions (voir, modifier, supprimer) --}}
                                <div class="d-flex">
                                <a href="{{ route('restaurants.show', $restaurant->id) }}" 
                                   class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @auth
                                    @if(Str::lower(trim(Auth::user()->role)) === 'client')
                                        <a href="{{ route('avis.create', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary btn-sm me-2">
                                            <i class="fas fa-comment"></i> Créer un avis
                                        </a>
                                    @endif
                                @endauth
                                @auth
    @if(Str::lower(trim(Auth::user()->role)) !== 'client')
        <a href="{{ route('restaurants.edit', $restaurant->id) }}" 
           class="btn btn-warning btn-sm me-2">
            <i class="fas fa-edit"></i> Modifier
        </a>
        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" name="id" value="{{ $restaurant->id }}">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
    @endif
@endauth
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    console.log("scripts !");
</script>
@endsection
