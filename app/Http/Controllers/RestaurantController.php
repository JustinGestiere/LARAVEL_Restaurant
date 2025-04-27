<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index() {
        // Si l'utilisateur est un employé, montrer uniquement les restaurants auxquels il est affilié
        if (Auth::check() && Auth::user()->role == 'employe') {
            $restaurants = Auth::user()->restaurantsEmploye()->with('categories')->get();

            if ($restaurants->isEmpty()) {
                return redirect()->route('items.index')
                    ->with('info', 'Vous n\'avez pas encore été attribué à un restaurant.');
            }

            return view('restaurants.index', ['restaurants' => $restaurants]);
        }

        // Si l'utilisateur est un restaurateur, montrer uniquement les restaurants auxquels il est affilié
        if (Auth::check() && Auth::user()->role == 'restaurateur') {
            $restaurants = Auth::user()->restaurantsRestaurateur()->with('categories')->get();

            if ($restaurants->isEmpty()) {
                return redirect()->route('restaurants.index')
                    ->with('info', 'Vous n\'êtes pas encore affilié à un restaurant.');
            }

            return view('restaurants.index', ['restaurants' => $restaurants]);
        }

        // Pour les admins et clients, montrer tous les restaurants
        return view('restaurants.index', [
            'restaurants' => Restaurant::with('categories')->get()
        ]);
    }

    public function create() {
        $restaurateurs = User::where('role', 'restaurateur')->get();
        $employes = User::where('role', 'employe')->get();
        return view('restaurants.create', [
            'restaurants' => Restaurant::with('categories')->get(),
            'restaurateurs' => $restaurateurs,
            'employes' => $employes
        ]);
    }

    public function store(Request $request) {
        $restaurant = Restaurant::create([ 'name' => $request->name ]);
        // Restaurateurs (optionnel)
        if ($request->has('restaurateurs')) {
            $restaurant->restaurateurs()->sync($request->restaurateurs);
        }
        // Employés (optionnel)
        if ($request->has('employes')) {
            $restaurant->employes()->sync($request->employes);
        }
        return redirect()->route('restaurants.index');
    }

    public function show($id) {
        $restaurant = Restaurant::with(['restaurateurs', 'employes'])
            ->findOrFail($id);
        // Charger les tables du restaurant
        $tables = \App\Models\Table::where('restaurant_id', $restaurant->id)->get();
        // Pour chaque table, vérifier si elle est disponible (aucune commande en cours, status != 'terminée')
        foreach ($tables as $table) {
            $hasActiveOrder = $table->orders()->where('status', '!=', 'terminée')->exists();
            $table->disponible = !$hasActiveOrder;
        }
        return view('restaurants.show', [
            'restaurant' => $restaurant,
            'tables' => $tables
        ]);
    }

    public function edit($id) {
        $restaurant = Restaurant::findOrFail($id);
        $restaurateurs = User::where('role', 'restaurateur')->get();
        $employes = User::where('role', 'employe')->get();
        $selectedRestaurateurs = $restaurant->restaurateurs->pluck('id')->toArray();
        $selectedEmployes = $restaurant->employes->pluck('id')->toArray();
        return view('restaurants.edit', [
            'restaurant' => $restaurant,
            'restaurateurs' => $restaurateurs,
            'employes' => $employes,
            'selectedRestaurateurs' => $selectedRestaurateurs,
            'selectedEmployes' => $selectedEmployes
        ]);
    }

    public function update(Request $request, $id) {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->get('name');
        $restaurant->save();
        // Mise à jour des restaurateurs affiliés
        if ($request->has('restaurateurs')) {
            $restaurant->restaurateurs()->sync($request->restaurateurs);
        } else {
            $restaurant->restaurateurs()->sync([]);
        }
        // Mise à jour des employés affiliés
        if ($request->has('employes')) {
            $restaurant->employes()->sync($request->employes);
        } else {
            $restaurant->employes()->sync([]);
        }
        return redirect()->route('restaurants.index');
    }

    public function destroy(Request $request, $id) {
        if($request->get('id') == $id) {
            Restaurant::destroy($id);
        }
        return redirect()->route('restaurants.index');
    }
}