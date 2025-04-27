@extends('layout.main')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Gestion des tables</h1>
    <a href="{{ route('tables.create') }}" class="btn btn-success mb-3">Ajouter une table</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Restaurant</th>
                <th>Places</th>
                <th>Réservée ?</th>
                <th>Par qui ?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
                <tr>
                    <td>{{ $table->name }}</td>
                    <td>{{ $table->restaurant->name ?? '-' }}</td>
                    <td>{{ $table->seats }}</td>
                    <td>
                        @php
                            $activeOrder = $table->orders()->where('status', '!=', 'terminée')->first();
                        @endphp
                        @if($activeOrder)
                            <span class="badge bg-warning">Oui</span>
                        @else
                            <span class="badge bg-success">Non</span>
                        @endif
                    </td>
                    <td>
                        @if($activeOrder)
                            {{ $activeOrder->user->name ?? 'Client inconnu' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette table ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
