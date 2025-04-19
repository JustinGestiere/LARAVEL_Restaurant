<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBaseController extends Controller
{
    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    protected function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Redirect if not admin.
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    protected function redirectIfNotAdmin()
    {
        if (!$this->isAdmin()) {
            return redirect('/')->with('error', 'Accès refusé. Vous devez être administrateur.');
        }
        
        return null;
    }
}
