<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;

class CategoryController extends Controller
{
    public function index() {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $categories = Category::with('restaurant')->get();
        } elseif ($user->role === 'restaurateur') {
            $restaurantIds = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            $categories = Category::whereIn('restaurant_id', $restaurantIds)->with('restaurant')->get();
        } elseif ($user->role === 'employe') {
            $restaurantIds = $user->restaurantsEmploye()->pluck('restaurants.id');
            $categories = Category::whereIn('restaurant_id', $restaurantIds)->with('restaurant')->get();
        } else {
            $categories = collect(); // client : rien
        }
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create() {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $restaurants = Restaurant::with('categories')->get();
        } elseif ($user->role === 'restaurateur') {
            $restaurants = $user->restaurantsRestaurateur()->with('categories')->get();
        } elseif ($user->role === 'employe') {
            $restaurants = $user->restaurantsEmploye()->with('categories')->get();
        } else {
            $restaurants = collect();
        }
        return view('categories.create', [
            'restaurants' => $restaurants
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        $restaurant_id = $request->get('restaurant_id');
        if ($user->role === 'admin') {
            // ok
        } elseif ($user->role === 'restaurateur') {
            $ids = $user->restaurantsRestaurateur()->pluck('restaurants.id');
            if (!$ids->contains($restaurant_id)) abort(403);
        } elseif ($user->role === 'employe') {
            $ids = $user->restaurantsEmploye()->pluck('restaurants.id');
            if (!$ids->contains($restaurant_id)) abort(403);
        } else {
            abort(403);
        }
        $category = new Category();
        $category->name = $request->get('name');
        $category->restaurant_id = $restaurant_id;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function show($id) {
        $category = Category::findOrFail($id);
        $user = auth()->user();
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
        return view('categories.show', ['category' => $category]);
    }

    public function edit($id) {
        return view('categories.edit', [
            'category' => Category::findOrFail($id),
            'restaurants' => Restaurant::all()
        ]);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->name = $request->get('name');
        $category->restaurant_id = $request->get('restaurant_id');

        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy(Request $request, $id) {
        if($request->get('id') == $id) {
            Category::destroy($id);
        }
        return redirect()->route('categories.index');
    }
}
