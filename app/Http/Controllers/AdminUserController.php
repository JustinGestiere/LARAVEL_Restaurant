<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends AdminBaseController
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $redirect = $this->redirectIfNotAdmin();
        if ($redirect) {
            return $redirect;
        }

        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $redirect = $this->redirectIfNotAdmin();
        if ($redirect) {
            return $redirect;
        }

        return view('users.create');
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $redirect = $this->redirectIfNotAdmin();
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
     * Show the form for editing a user.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $redirect = $this->redirectIfNotAdmin();
        if ($redirect) {
            return $redirect;
        }

        $user = User::findOrFail($id);
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $redirect = $this->redirectIfNotAdmin();
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
     * Remove the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $redirect = $this->redirectIfNotAdmin();
        if ($redirect) {
            return $redirect;
        }

        User::destroy($id);
        
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
