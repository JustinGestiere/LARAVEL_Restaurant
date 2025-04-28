{{--
    Page : categories/index.blade.php
    Description : Liste des catégories avec options de création, modification, suppression.
--}}
@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Catégories</h1>

    @if(Auth::check() && Str::lower(trim(Auth::user()->role)) !== 'client')
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Créer une catégorie
    </a>
    @endif

        {{-- Tableau des catégories --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Restaurant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('restaurants.show', $category->restaurant->id) }}" 
                               class="text-decoration-none text-primary">
                                {{ $category->restaurant->name }}
                            </a>
                        </td>
                        <td>
                                                            {{-- Actions (voir, modifier, supprimer) --}}
                                <div class="d-flex">
                                <a href="{{ route('categories.show', $category->id) }}" 
                                   class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                   class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" 

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                <!-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $category->id }}">
                <button type="submit">Supprimer</button>
            </form>
        </div> -->
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
