{{--
    Page : orders/show.blade.php
    Description : Affichage des détails d'une commande (items, quantités, total, actions).
--}}
@extends('layout.main')
@section('content')
<div class="container mt-5">
    {{-- Détails de la commande --}}
    <h1 class="mb-4 text-primary">Détail de la commande #{{ $order->id }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
    <div class="card shadow-lg p-4 mb-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Utilisateur :</strong> {{ $order->user->name ?? '-' }}</li>
            <li class="list-group-item"><strong>Restaurant :</strong> {{ $order->restaurant->name ?? '-' }}</li>
            <li class="list-group-item"><strong>Table :</strong> {{ $order->table->id ?? '-' }}</li>
            <li class="list-group-item"><strong>Total :</strong> {{ number_format($order->total / 100, 2) }} €</li>
            <li class="list-group-item"><strong>Statut :</strong> {{ $order->status }}</li>
            <li class="list-group-item"><strong>Créée le :</strong> {{ $order->created_at }}</li>
        </ul>
    </div>
    <h3>Détails des items</h3>
    <ul class="list-group mb-4">
        @foreach($order->items as $item)
            <li class="list-group-item">
                {{ $item->name }} x {{ $item->pivot->quantity }} ({{ number_format($item->pivot->price / 100, 2) }} €)
            </li>
        @endforeach
    </ul>
    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'restaurateur' || Auth::user()->role == 'employe'))
    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Modifier</a>
@endif
<form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>
</div>
@endsection
