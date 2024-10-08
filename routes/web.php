<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShoppingMemoController;
use Illuminate\Support\Facades\Route;

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', fn() => view('auth.login'));
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('recipes/home', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipes/show/{id}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('recipes', [RecipeController::class, 'store'])->name('recipes.store');

Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/store/{$recipeId}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/delete/{$recipeId}', [FavoriteController::class, 'delete'])->name('favorites.delete');

Route::get('/Memos', [ShoppingMemoController::class, 'index'])->name('memos.index');
Route::get('/Memos/show/{id}', [ShoppingMemoController::class, 'show'])->name('memos.show');
Route::get('Memos/create', [ShoppingMemoController::class, 'create'])->name('memos.create');
Route::post('Memos/store', [ShoppingMemoController::class, 'store'])->name('memos.store');