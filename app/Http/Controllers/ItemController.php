<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index() {
        return view('items.index', [
            'items' => Item::with('categories')->get()
        ]);
    }

    public function create() {
        return view('items.create', [
            'items' => Item::with('categories')->get()
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
