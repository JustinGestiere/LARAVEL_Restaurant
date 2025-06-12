<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

// API tables disponibles (pour le JS du formulaire commande)
Route::get('/api/tables-disponibles', [OrderController::class, 'apiTablesDisponibles']);

// Routes publiques - PAS DE CLOSURES
Route::get('/', [HomeController::class, 'index']);
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');

// Routes pour les avis
Route::get('/restaurants/{restaurant}/avis/create', [App\Http\Controllers\AvisController::class, 'create'])->name('avis.create')->middleware('auth');
Route::post('/restaurants/{restaurant}/avis', [App\Http\Controllers\AvisController::class, 'store'])->name('avis.store')->middleware('auth');

// Routes authentifiées - TOUTES INDIVIDUELLES SANS GROUPE
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Profil
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');

// Utilisateurs
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');
Route::post('/users', [UserController::class, 'store'])->middleware('auth')->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth')->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');

// Restaurants
Route::get('/restaurants/create', [RestaurantController::class, 'create'])->middleware('auth')->name('restaurants.create');
Route::post('/restaurants', [RestaurantController::class, 'store'])->middleware('auth')->name('restaurants.store');
Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->middleware('auth')->name('restaurants.edit');
Route::put('/restaurants/{id}/update', [RestaurantController::class, 'update'])->middleware('auth')->name('restaurants.update');
Route::delete('/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->middleware('auth')->name('restaurants.destroy');

// Catégories
Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth')->name('categories.index');
Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->middleware('auth')->name('categories.show');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware('auth')->name('categories.edit');
Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->middleware('auth')->name('categories.update');
Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->middleware('auth')->name('categories.destroy');

// Items
Route::get('/items', [ItemController::class, 'index'])->middleware('auth')->name('items.index');
Route::get('/items/{id}/show', [ItemController::class, 'show'])->middleware('auth')->name('items.show');
Route::get('/items/create', [ItemController::class, 'create'])->middleware('auth')->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->middleware('auth')->name('items.store');
Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->middleware('auth')->name('items.edit');
Route::put('/items/{id}/update', [ItemController::class, 'update'])->middleware('auth')->name('items.update');
Route::delete('/items/{id}/destroy', [ItemController::class, 'destroy'])->middleware('auth')->name('items.destroy');

// Commandes
Route::resource('orders', OrderController::class)->middleware('auth');

// Tables (Salle)
Route::resource('tables', TableController::class)->middleware('auth');

// Routes d'authentification
require __DIR__.'/auth.php';
