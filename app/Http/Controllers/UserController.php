<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Affiche la liste des utilisateurs
    public function index() {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    // Affiche le formulaire de création
    public function create() {
        return view('users.create');
    }

    // Enregistre un nouvel utilisateur
    public function store(Request $request) {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,client,restaurateur,employe',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('users.index');
    }

    // Affiche le formulaire d'édition
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Met à jour un utilisateur
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,client,restaurateur,employe',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }
        $user->update($validated);
        return redirect()->route('users.index');
    }

    // Supprime un utilisateur
    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('users.index');
    }
}
