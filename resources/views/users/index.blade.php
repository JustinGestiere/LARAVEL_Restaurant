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
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}" data-name="{{ $user->prenom }} {{ $user->name }}">
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

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong id="userName"></strong> ?</p>
                <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Cette action est irréversible !</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables pour stocker l'ID de l'utilisateur à supprimer et le formulaire associé
        let userId = null;
        let formToSubmit = null;
        
        // Ajouter un gestionnaire d'événements à tous les boutons de suppression
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Récupérer l'ID et le nom de l'utilisateur à partir des attributs data
                userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                
                // Stocker le formulaire à soumettre
                formToSubmit = this.closest('form');
                
                // Mettre à jour le contenu de la modal
                document.getElementById('userName').textContent = userName;
                
                // Afficher la modal
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
        
        // Ajouter un gestionnaire d'événements au bouton de confirmation
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (formToSubmit) {
                // Soumettre le formulaire
                formToSubmit.submit();
            }
        });
    });
</script>
@endsection
@endsection
