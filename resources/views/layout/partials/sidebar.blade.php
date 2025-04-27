{{-- Sidebar --}}
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">Commandes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">Items</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('restaurants.index') }}">Restaurants</a>
    </li>
    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'restaurateur', 'employe']))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tables.index') }}">Salle</a>
    </li>
    @endif
</ul>
