<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Constructeur
     */
    public function __construct()
    {
        // L'authentification est gérée dans les routes
    }
    
    /**
     * Vérifie si l'utilisateur est un admin
     */
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Accès refusé. Vous devez être administrateur.');
        }
        return null;
    }

    /**
     * Affiche la liste des utilisateurs
     */
    public function index() {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create() {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request) {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,client,restaurateur,employe',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id) {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, $id) {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,client,restaurateur,employe',
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $validated['password'] = Hash::make($request->password);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy($id) {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }
        
        // Empêcher la suppression du propre compte de l'utilisateur connecté
        if (Auth::id() == $id) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }
        
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
