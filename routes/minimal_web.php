<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route d'accueil uniquement
Route::get('/', function() {
    return view('layout/main');
});

// Routes publiques pour les restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');

// Route d'authentification
require __DIR__.'/auth.php';
