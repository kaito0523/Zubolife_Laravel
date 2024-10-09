<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShoppingMemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', fn() => view('auth.register'))->name('register.index');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', fn() => view('auth.login'))->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('recipes/home', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipes/show/{id}', [RecipeController::class, 'show'])->name('recipes.show');

Route::middleware('auth')->group(function () {
    Route::get('recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('recipes', [RecipeController::class, 'store'])->name('recipes.store');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/store/{recipeId}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/delete/{recipeId}', [FavoriteController::class, 'delete'])->name('favorites.delete');

    Route::get('/memos', [ShoppingMemoController::class, 'index'])->name('memos.index');
    Route::get('/memos/show/{id}', [ShoppingMemoController::class, 'show'])->name('memos.show');
    Route::get('memos/create', [ShoppingMemoController::class, 'create'])->name('memos.create');
    Route::post('memos/store', [ShoppingMemoController::class, 'store'])->name('memos.store');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/recipes/{id}/edit', [ProfileController::class, 'editRecipe'])->name('profile.editRecipe');
    Route::patch('/profile/recipes/{id}', [ProfileController::class, 'updateRecipe'])->name('profile.updateRecipe');
    Route::delete('/profile/recipes/{id}', [ProfileController::class, 'destroyRecipe'])->name('profile.destroyRecipe');
});
