@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Commandes</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('orders.create') }}" class="btn btn-success mb-3">Nouvelle commande</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Restaurant</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>{{ $order->restaurant->name ?? '-' }}</td>
                        <td>{{ number_format($order->total / 100, 2) }} €</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm me-2">Voir</a>
                            @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'restaurateur' || Auth::user()->role == 'employe'))
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm me-2">Modifier</a>
                            @endif
                            @if(Auth::user()->role == 'admin' || (Auth::user()->role != 'client' && isset($order->restaurant_id) && Auth::user()->restaurant_id == $order->restaurant_id) || (Auth::user()->role == 'client' && $order->user_id == Auth::id()))
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection
