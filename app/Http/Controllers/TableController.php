<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $tables = Table::with('restaurant')->get();
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            $tables = Table::whereIn('restaurant_id', $restaurantIds)->with('restaurant')->get();
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            $tables = Table::whereIn('restaurant_id', $restaurantIds)->with('restaurant')->get();
        } else {
            $tables = collect();
        }
        return view('tables.index', compact('tables'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $restaurants = Restaurant::all();
        } elseif ($user->role === 'restaurateur') {
            $restaurants = $user->restaurantsRestaurateur()->get();
        } elseif ($user->role === 'employe') {
            $restaurants = $user->restaurantsEmploye()->get();
        } else {
            $restaurants = collect();
        }
        return view('tables.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $restaurant_id = $request->get('restaurant_id');
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $ids = $user->restaurantsRestaurateur()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas créer une table dans ce restaurant.");
            }
        } elseif ($user->role === 'employe') {
            $ids = $user->restaurantsEmploye()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas créer une table dans ce restaurant.");
            }
        } else {
            return redirect()->back()->with('error', "Accès non autorisé");
        }
        $request->validate([
            'name' => 'required',
            'seats' => 'required|integer|min:1',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);
        Table::create([
            'name' => $request->name,
            'seats' => $request->seats,
            'restaurant_id' => $restaurant_id,
        ]);
        return redirect()->route('tables.index')->with('success', 'Table créée !');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);
        $user = auth()->user();
        if ($user->role === 'admin') {
            $restaurants = Restaurant::all();
        } elseif ($user->role === 'restaurateur') {
            $restaurants = $user->restaurantsRestaurateur()->get();
        } elseif ($user->role === 'employe') {
            $restaurants = $user->restaurantsEmploye()->get();
        } else {
            $restaurants = collect();
        }
        return view('tables.edit', compact('table', 'restaurants'));
    }

    public function update(Request $request, $id)
    {
        $table = Table::findOrFail($id);
        $user = auth()->user();
        $restaurant_id = $request->get('restaurant_id');
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $ids = $user->restaurantsRestaurateur()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas modifier une table dans ce restaurant.");
            }
        } elseif ($user->role === 'employe') {
            $ids = $user->restaurantsEmploye()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas modifier une table dans ce restaurant.");
            }
        } else {
            return redirect()->back()->with('error', "Accès non autorisé");
        }
        $request->validate([
            'name' => 'required',
            'seats' => 'required|integer|min:1',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);
        $table->update([
            'name' => $request->name,
            'seats' => $request->seats,
            'restaurant_id' => $restaurant_id,
        ]);
        return redirect()->route('tables.index')->with('success', 'Table modifiée !');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $user = auth()->user();
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $ids = $user->restaurantsRestaurateur()->pluck('restaurants.id')->toArray();
            if (!in_array($table->restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas supprimer une table dans ce restaurant.");
            }
        } elseif ($user->role === 'employe') {
            $ids = $user->restaurantsEmploye()->pluck('restaurants.id')->toArray();
            if (!in_array($table->restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas supprimer une table dans ce restaurant.");
            }
        } else {
            return redirect()->back()->with('error', "Accès non autorisé");
        }
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table supprimée !');
    }
}
