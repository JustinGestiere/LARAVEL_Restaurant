<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layout/main');
    }
    
    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        // Si l'utilisateur est un employé, le rediriger vers la page des items
        if (Auth::user()->role == 'employe') {
            return redirect()->route('items.index')->with('info', 'Les employés n\'ont pas accès au tableau de bord.');
        }
        
        // Pour les autres rôles, afficher le tableau de bord avec les statistiques
        $stats = [
            'restaurants' => Restaurant::count(),
            'categories' => Category::count(),
            'items' => Item::count(),
            'users' => User::count()
        ];
        
        return view('dashboard', compact('stats'));
    }
}