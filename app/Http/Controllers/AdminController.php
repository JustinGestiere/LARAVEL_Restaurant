<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Vérification effectuée dans les méthodes
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        $redirect = $this->redirectIfNotAdmin();
        if ($redirect) {
            return $redirect;
        }

        $nbClients = User::where('role', 'client')->count();
        $nbAdmins = User::where('role', 'admin')->count();
        $nbRestaurateurs = User::where('role', 'restaurateur')->count();
        $nbEmployes = User::where('role', 'employe')->count();
        $nbRestaurants = Restaurant::count();
        $nbCategories = Category::count();
        $nbItems = Item::count();
        
        return view('admin.dashboard', compact(
            'nbClients',
            'nbAdmins',
            'nbRestaurateurs',
            'nbEmployes',
            'nbRestaurants',
            'nbCategories',
            'nbItems'
        ));
    }
}
