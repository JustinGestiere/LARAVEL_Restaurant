@extends('layout.main')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary">Gestion des utilisateurs</h1>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted">Total: {{ count($users) }} utilisateurs</p>
        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajouter un utilisateur
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-danger">Admin</span>
                        @elseif($user->role == 'restaurateur')
                            <span class="badge bg-primary">Restaurateur</span>
                        @elseif($user->role == 'employe')
                            <span class="badge bg-info">Employé</span>
                        @else
                            <span class="badge bg-success">Client</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            @if(Auth::id() != $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
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
    
    @if(count($users) == 0)
    <div class="alert alert-info mt-3">
        Aucun utilisateur trouvé.
    </div>
    @endif
</div>
@endsection
