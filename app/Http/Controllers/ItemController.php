<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index() {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $items = Item::with('category')->get();
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            $categoryIds = \App\Models\Category::whereIn('restaurant_id', $restaurantIds)->pluck('id');
            $items = Item::whereIn('category_id', $categoryIds)->with('category')->get();
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            $categoryIds = \App\Models\Category::whereIn('restaurant_id', $restaurantIds)->pluck('id');
            $items = Item::whereIn('category_id', $categoryIds)->with('category')->get();
        } else {
            $items = collect(); // client : rien
        }
        return view('items.index', [
            'items' => $items
        ]);
    }

    public function create() {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $categories = Category::all();
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            $categories = Category::whereIn('restaurant_id', $restaurantIds)->get();
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            $categories = Category::whereIn('restaurant_id', $restaurantIds)->get();
        } else {
            $categories = collect();
        }
        return view('items.create', [
            'categories' => $categories
        ]);
    }
    

    public function store(Request $request) {
        $user = auth()->user();
        $category_id = $request->get('category_id');
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            $ids = \App\Models\Category::whereIn('restaurant_id', $restaurantIds)->pluck('id');
            if (!$ids->contains($category_id)) abort(403);
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            $ids = \App\Models\Category::whereIn('restaurant_id', $restaurantIds)->pluck('id');
            if (!$ids->contains($category_id)) abort(403);
        } else {
            abort(403);
        }
        Item::create($request->all());
        return redirect()->route('items.index');
    }

    public function show($id) {
        $item = Item::findOrFail($id);
        $user = auth()->user();
        $category = $item->category;
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            if (!$restaurantIds->contains($category->restaurant_id)) { abort(403); }
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            if (!$restaurantIds->contains($category->restaurant_id)) { abort(403); }
        } else {
            abort(403);
        }
        return view('items.show', [
            'item' => $item
        ]);
    }

    public function edit($id) {
        // Vérifie si l'utilisateur est un employé
        if (Auth::user()->role == 'employe') {
            return redirect()->route('items.index')->with('error', 'Les employés ne sont pas autorisés à modifier les items.');
        }
        
        return view('items.edit', [
            'item' => Item::findOrFail($id),
            'categories' => Category::all() // Ajout de la variable $categories
        ]);
    }

    public function update(Request $request, $id) {
        // Vérifie si l'utilisateur est un employé
        if (Auth::user()->role == 'employe') {
            return redirect()->route('items.index')->with('error', 'Les employés ne sont pas autorisés à modifier les items.');
        }
        
        $item = Item::findOrFail($id);

        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->price = $request->get('price');
        $item->description = $request->get('description');
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item modifié avec succès');
    }

    public function destroy(Request $request, $id) {
        // Vérifie si l'utilisateur est un employé
        if (Auth::user()->role == 'employe') {
            return redirect()->route('items.index')->with('error', 'Les employés ne sont pas autorisés à supprimer les items.');
        }
        
        if($request->get('id') == $id) {
            Item::destroy($id);
            return redirect()->route('items.index')->with('success', 'Item supprimé avec succès');
        }
        return redirect()->route('items.index');
    }
}
