<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// Routes publiques
Route::get('/', [HomeController::class, 'index']);
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');

// Dashboard admin
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes admin
Route::middleware('auth')->prefix('admin')->group(function () {
    // Utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Routes authentifiées
Route::middleware('auth')->group(function () {
    // Restaurants
    Route::get('/admin/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
    Route::post('/admin/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
    Route::get('/admin/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/admin/restaurants/{id}/update', [RestaurantController::class, 'update'])->name('restaurants.update');
    Route::delete('/admin/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

    // Catégories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Items
    Route::get('/admin/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/admin/items/{id}/show', [ItemController::class, 'show'])->name('items.show');
    Route::get('/admin/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/admin/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/admin/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/admin/items/{id}/update', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/admin/items/{id}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');
});

require __DIR__.'/auth.php';
