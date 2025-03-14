@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Items</h1>

    <a href="{{ route('items.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Créer un item
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Coûts</th>
                    <th>Catégories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price / 100, 2) }} €</td>
                        <td>{{ number_format($item->cost / 100, 2) }} €</td>
                        <td>
                            <a href="{{ route('categories.show', $item->category->id) }}" 
                               class="text-decoration-none text-primary">
                                {{ $item->category->name }}
                            </a>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('items.show', $item->id) }}" 
                                   class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('items.edit', $item->id) }}" 
                                   class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</button>
                                </form>
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
