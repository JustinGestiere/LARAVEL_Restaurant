<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Retourne les tables disponibles pour un restaurant et un nombre de personnes donné (API simple).
     */
    public function apiTablesDisponibles(Request $request)
    {
        $restaurant_id = $request->query('restaurant_id');
        $nb_personnes = $request->query('nb_personnes', 1);
        $tables = \App\Models\Table::where('restaurant_id', $restaurant_id)
            ->where('seats', '>=', $nb_personnes)
            ->get();
        $tables_disponibles = [];
        foreach ($tables as $table) {
            $hasActiveOrder = $table->orders()->where('status', '!=', 'terminée')->exists();
            if (!$hasActiveOrder) {
                $tables_disponibles[] = [
                    'id' => $table->id,
                    'name' => $table->name,
                    'seats' => $table->seats
                ];
            }
        }
        return response()->json($tables_disponibles);
    }
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $orders = Order::latest()->paginate(10);
        } elseif ($user->role === 'restaurateur') {
            $orders = Order::where('restaurant_id', $user->restaurant_id)->latest()->paginate(10);
        } elseif ($user->role === 'employe') {
            $orders = Order::where('restaurant_id', $user->restaurant_id)->latest()->paginate(10);
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->paginate(10);
        }
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);
        return view('orders.show', compact('order'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $restaurants = \App\Models\Restaurant::all();
        } elseif ($user->role === 'restaurateur') {
            $restaurants = $user->restaurantsRestaurateur()->get();
        } elseif ($user->role === 'employe') {
            $restaurants = $user->restaurantsEmploye()->get();
        } else {
            $restaurants = collect();
        }
        $items = \App\Models\Item::all();
        return view('orders.create', [
            'restaurants' => $restaurants,
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
            'quantities' => 'required|array',
        ]);
        $user = auth()->user();
        $restaurant_id = $request->restaurant_id;
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $ids = $user->restaurantsRestaurateur()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas commander dans ce restaurant.");
            }
        } elseif ($user->role === 'employe') {
            $ids = $user->restaurantsEmploye()->pluck('restaurants.id')->toArray();
            if (!in_array($restaurant_id, $ids)) {
                return redirect()->back()->with('error', "Vous ne pouvez pas commander dans ce restaurant.");
            }
        } else {
            return redirect()->back()->with('error', "Accès non autorisé");
        }
        $order = new Order();
        $order->user_id = Auth::id();
        $order->restaurant_id = $restaurant_id;
        $order->status = 'en attente';
        $order->total = 0;
        $order->save();
        $total = 0;
        $selected_items = $request->selected_items ?? [];
        $quantities = $request->quantities ?? [];
        if (empty($selected_items)) {
            return redirect()->back()->with('error', 'Veuillez sélectionner au moins un item.');
        }
        foreach ($selected_items as $i => $item_id) {
            $quantity = $request->quantities[$i];
            $item = Item::find($item_id);
            $order->items()->attach($item_id, [
                'quantity' => $quantity,
                'price' => $item->price,
            ]);
            $total += $item->price * $quantity;
        }
        $order->total = $total;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Commande créée !');
    }

    public function edit(Order $order)
    {
        if (auth()->user()->role === 'client') {
            abort(403, 'Les clients ne peuvent pas modifier le statut des commandes.');
        }
        $this->authorizeOrder($order);
        $restaurants = Restaurant::all();
        $items = Item::all();
        return view('orders.edit', compact('order', 'restaurants', 'items'));
    }

    public function update(Request $request, Order $order)
    {
        if (auth()->user()->role === 'client') {
            abort(403, 'Les clients ne peuvent pas modifier le statut des commandes.');
        }
        $this->authorizeOrder($order);
        $validated = $request->validate([
            'status' => 'required|string',
        ]);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.show', $order)->with('success', 'Commande mise à jour !');
    }

    public function destroy(Order $order)
    {
        $this->authorizeOrder($order);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée !');
    }

    private function authorizeOrder(Order $order)
    {
        $user = Auth::user();
        if ($user->role === 'admin') return true;
        if ($user->role === 'restaurateur' || $user->role === 'employe') {
            if ($order->restaurant_id == $user->restaurant_id) return true;
        }
        if ($user->role === 'client' && $order->user_id == $user->id) return true;
        abort(403);
    }
}
