<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Item;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $nbClients = User::where('role', 'client')->count();
        $nbAdmins = User::where('role', 'admin')->count();
        $nbRestaurateurs = User::where('role', 'restaurateur')->count();
        $nbEmployes = User::where('role', 'employe')->count();
        $nbRestaurants = Restaurant::count();
        $nbCategories = Category::count();
        $nbItems = Item::count();
        return view('admin.dashboard', compact('nbClients','nbAdmins','nbRestaurateurs','nbEmployes','nbRestaurants','nbCategories','nbItems'));
    }
}
