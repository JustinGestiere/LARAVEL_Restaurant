@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Restaurants</h1>

    @if(Auth::check())
    <a href="{{ route('restaurants.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Créer un restaurant
    </a>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('restaurants.show', $restaurant->id) }}" 
                                   class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @if(Auth::check())
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
