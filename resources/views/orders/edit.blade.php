{{--
    Page : orders/edit.blade.php
    Description : Formulaire d'édition d'une commande existante (modification des items, quantités, table, etc).
--}}
@extends('layout.main')
@section('content')
<div class="container mt-5">
    {{-- Formulaire d'édition de commande --}}
    <h1 class="mb-4 text-primary">Modifier la commande #{{ $order->id }}</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
        {{-- Champs du formulaire --}}
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select" required>
                <option value="en attente" @if($order->status=='en attente') selected @endif>En attente</option>
                <option value="en cours" @if($order->status=='en cours') selected @endif>En cours</option>
                <option value="servie" @if($order->status=='servie') selected @endif>Servie</option>
                <option value="annulée" @if($order->status=='annulée') selected @endif>Annulée</option>
            </select>
        </div>
                {{-- Bouton de validation --}}
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    {{-- Fin du formulaire --}}
</div>
@endsection
{{-- Fin du fichier --}}
