<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index() {
        // Si l'utilisateur est un employé, montrer uniquement le restaurant auquel il est attribué
        if (Auth::user()->role == 'employe') {
            $restaurants = Restaurant::with('categories')
                ->where('employe_id', Auth::id())
                ->get();
                
            if ($restaurants->isEmpty()) {
                return redirect()->route('items.index')
                    ->with('info', 'Vous n\'avez pas encore été attribué à un restaurant.');
            }
            
            return view('restaurants.index', ['restaurants' => $restaurants]);
        }
        
        // Si l'utilisateur est un restaurateur, montrer uniquement ses restaurants
        if (Auth::user()->role == 'restaurateur') {
            $restaurants = Restaurant::with('categories')
                ->where('restaurateur_id', Auth::id())
                ->get();
            return view('restaurants.index', ['restaurants' => $restaurants]);
        }
        
        // Pour les admins et clients, montrer tous les restaurants
        return view('restaurants.index', [
            'restaurants' => Restaurant::with('categories')->get()
        ]);
    }

    public function create() {
        // return view('restaurants.create');
        return view('restaurants.create', [
            'restaurants' => Restaurant::with('categories')->get()
        ]);
    }

    public function store(Request $request) {
        Restaurant::create( $request->all() );
        
        return redirect()->route('restaurants.index');
    }

    public function show($id) {
        return view('restaurants.show', 
        ['restaurant' => Restaurant::findOrFail($id)]);
    }

    public function edit($id) {
        return view('restaurants.edit', [
            'restaurant' => Restaurant::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id) {
        $restaurant = Restaurant::findOrFail($id);

        $restaurant->name = $request->get('name');
        $restaurant->save();

        return redirect()->route('restaurants.index');
    }

    public function destroy(Request $request, $id) {
        if($request->get('id') == $id) {
            Restaurant::destroy($id);
        }
        return redirect()->route('restaurants.index');
    }
}