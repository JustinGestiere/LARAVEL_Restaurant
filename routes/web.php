<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// Route d'accueil - accessible à tous
Route::get('/', [HomeController::class, 'index']);

// Routes publiques pour les restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');

// Routes authentifiées individuelles (sans groupe)
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');

// Routes admin individuelles (sans groupe)
Route::get('/admin/users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');
Route::post('/admin/users', [UserController::class, 'store'])->middleware('auth')->name('users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->middleware('auth')->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');

// Routes restaurants (admin)
Route::get('/admin/restaurants/create', [RestaurantController::class, 'create'])->middleware('auth')->name('restaurants.create');
Route::post('/admin/restaurants', [RestaurantController::class, 'store'])->middleware('auth')->name('restaurants.store');
Route::get('/admin/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->middleware('auth')->name('restaurants.edit');
Route::put('/admin/restaurants/{id}/update', [RestaurantController::class, 'update'])->middleware('auth')->name('restaurants.update');
Route::delete('/admin/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->middleware('auth')->name('restaurants.destroy');

// Routes catégories (admin)
Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware('auth')->name('categories.index');
Route::get('/admin/categories/{id}/show', [CategoryController::class, 'show'])->middleware('auth')->name('categories.show');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware('auth')->name('categories.edit');
Route::put('/admin/categories/{id}/update', [CategoryController::class, 'update'])->middleware('auth')->name('categories.update');
Route::delete('/admin/categories/{id}/destroy', [CategoryController::class, 'destroy'])->middleware('auth')->name('categories.destroy');

// Routes items (admin)
Route::get('/admin/items', [ItemController::class, 'index'])->middleware('auth')->name('items.index');
Route::get('/admin/items/{id}/show', [ItemController::class, 'show'])->middleware('auth')->name('items.show');
Route::get('/admin/items/create', [ItemController::class, 'create'])->middleware('auth')->name('items.create');
Route::post('/admin/items', [ItemController::class, 'store'])->middleware('auth')->name('items.store');
Route::get('/admin/items/{id}/edit', [ItemController::class, 'edit'])->middleware('auth')->name('items.edit');
Route::put('/admin/items/{id}/update', [ItemController::class, 'update'])->middleware('auth')->name('items.update');
Route::delete('/admin/items/{id}/destroy', [ItemController::class, 'destroy'])->middleware('auth')->name('items.destroy');

// Routes d'authentification
require __DIR__.'/auth.php';
