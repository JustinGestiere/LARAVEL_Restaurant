@extends('layout.main')

@section('main')
    <h1>Modification item</h1>

    <a href="{{ route('items.index') }}">Retour à la liste</a>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('put')
        <div>
            <label for="name">Nom : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $item->name }}">
        </div>
        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    @if($category->id == $item->category->id)
                        <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <label for="name">Price : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $item->price/100 }} €">
        </div>
        <div>
            <label for="name">Coût : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $item->cost/100 }} €">
        </div>
        <button type="submit">Envoyer</button>  
    </form>
@endsection