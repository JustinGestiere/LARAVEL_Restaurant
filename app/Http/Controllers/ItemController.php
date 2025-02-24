<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

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
        return view('items.edit', [
            'item' => Item::findOrFail($id),
            'categories' => Category::all() // Ajout de la variable $categories
        ]);
    }

    public function update(Request $request, $id) {
        $restaurant = Item::findOrFail($id);

        $restaurant->name = $request->get('name');
        $restaurant->save();

        return redirect()->route('items.index');
    }

    public function destroy(Request $request, $id) {
        if($request->get('id') == $id) {
            Item::destroy($id);
        }
        return redirect()->route('items.index');
    }
}
