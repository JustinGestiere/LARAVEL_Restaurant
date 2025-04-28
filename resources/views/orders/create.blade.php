{{--
    Page : orders/create.blade.php
    Description : Formulaire de création d'une nouvelle commande (choix restaurant, table, items, quantités, etc)
--}}
@extends('layout.main')
@section('content')
<div class="container mt-5">
    {{-- En-tête et bouton retour --}}
    <h1 class="mb-4 text-primary">Nouvelle commande</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>
        {{-- Formulaire de création de commande --}}
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
                {{-- Sélection du type de commande --}}
        <div class="mb-3">
            <label class="form-label">Type de commande</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order_type" id="sur_place" value="sur_place" checked>
                <label class="form-check-label" for="sur_place">Sur place</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order_type" id="a_emporter" value="a_emporter">
                <label class="form-check-label" for="a_emporter">À emporter</label>
            </div>
        </div>
                {{-- Sélection du restaurant --}}
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">Sélectionner un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
                {{-- Nombre de personnes (si sur place) --}}
        <div class="mb-3" id="nb_personnes_block">
            <label for="nb_personnes" class="form-label">Nombre de personnes</label>
            <input type="number" min="1" name="nb_personnes" id="nb_personnes" class="form-control" value="1" required>
        </div>
                {{-- Sélection de la table (si sur place) --}}
        <div class="mb-3" id="table_block">
            <label for="table_id" class="form-label">Table (si sur place)</label>
            <select name="table_id" id="table_id" class="form-select">
                <option value="">Sélectionner une table</option>
                <!-- Les options seront injectées dynamiquement en JS -->
            </select>
            <div id="no_table_msg" class="text-danger mt-2" style="display:none;">Plus de place disponible pour ce nombre de personnes.</div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderTypeRadios = document.querySelectorAll('input[name="order_type"]');
            const nbPersonnesBlock = document.getElementById('nb_personnes_block');
            const tableBlock = document.getElementById('table_block');
            const nbPersonnesInput = document.getElementById('nb_personnes');
            const restaurantSelect = document.getElementById('restaurant_id');
            const tableSelect = document.getElementById('table_id');
            const noTableMsg = document.getElementById('no_table_msg');

            function updateTableBlock() {
                if(document.getElementById('sur_place').checked) {
                    nbPersonnesBlock.style.display = '';
                    tableBlock.style.display = '';
                    fetchTables();
                } else {
                    nbPersonnesBlock.style.display = 'none';
                    tableBlock.style.display = 'none';
                }
            }

            function fetchTables() {
                const nb = nbPersonnesInput.value;
                const restId = restaurantSelect.value;
                if(!restId || !nb) {
                    tableSelect.innerHTML = '<option value="">Sélectionner une table</option>';
                    noTableMsg.style.display = 'none';
                    return;
                }
                fetch(`/api/tables-disponibles?restaurant_id=${restId}&nb_personnes=${nb}`)
                    .then(r => r.json())
                    .then(data => {
                        tableSelect.innerHTML = '<option value="">Sélectionner une table</option>';
                        if(data.length === 0) {
                            noTableMsg.style.display = '';
                        } else {
                            noTableMsg.style.display = 'none';
                            data.forEach(table => {
                                tableSelect.innerHTML += `<option value="${table.id}">${table.name} (${table.seats} places)</option>`;
                            });
                        }
                    });
            }

            orderTypeRadios.forEach(radio => radio.addEventListener('change', updateTableBlock));
            nbPersonnesInput.addEventListener('input', fetchTables);
            restaurantSelect.addEventListener('change', fetchTables);
            updateTableBlock();
        });
        </script>
                {{-- Sélection des items --}}
        <div class="mb-3">
            <label for="items" class="form-label">Items</label>
            <select name="items[]" id="items" class="form-select" multiple required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} ({{ number_format($item->price / 100, 2) }} €)</option>
                @endforeach
            </select>
        </div>
                {{-- Bloc pour la saisie des quantités par item --}}
        <div id="quantities_block"></div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ... (code existant pour tables)
            const itemsSelect = document.getElementById('items');
            const quantitiesBlock = document.getElementById('quantities_block');
            function updateQuantities() {
                const selected = Array.from(itemsSelect.selectedOptions);
                let html = '';
                selected.forEach(option => {
                    html += `<div class='mb-2'>
                        <label>Quantité pour <strong>${option.text}</strong> :</label>
                        <input type='number' name='quantities[]' min='1' value='1' class='form-control' required />
                        <input type='hidden' name='selected_items[]' value='${option.value}' />
                    </div>`;
                });
                quantitiesBlock.innerHTML = html;
            }
            itemsSelect.addEventListener('change', updateQuantities);
            updateQuantities();
        });
        </script>
                {{-- Bouton de validation du formulaire --}}
        <button type="submit" class="btn btn-primary">Valider la commande</button>
    </form>
</div>
@endsection
