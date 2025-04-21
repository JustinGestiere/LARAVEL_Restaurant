<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index() {
        return view('items.index', [
            'items' => Item::with('category')->get() //modification du categories en category
        ]);
    }

    public function create() {
        // Récupère toutes les catégories
        $categories = Category::all();
    
        return view('items.create', [
            'categories' => $categories  // Passe la variable $categories à la vue
        ]);
    }
    

    public function store(Request $request) {
        Item::create( $request->all() );
        
        return redirect()->route('items.index');
    }

    public function show($id) {
        return view('items.show', [
            'item' => Item::findOrFail($id)
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
