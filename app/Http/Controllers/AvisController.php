<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    // Affiche le formulaire de création d'avis
    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return view('avis.create', compact('restaurant'));
    }

    // Enregistre un nouvel avis
    public function store(Request $request, $restaurantId)
    {
        $request->validate([
            'avis' => 'required|string',
            'note' => 'required|integer|min:1|max:5',
        ]);

        Avis::create([
            'id_client' => Auth::id(),
            'id_restaurant' => $restaurantId,
            'avis' => $request->avis,
            'note' => $request->note,
            'date' => now(),
        ]);

        return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Avis ajouté !');
    }
}
