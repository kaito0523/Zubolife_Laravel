<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShoppingMemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register.index');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login.index');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('recipes', RecipeController::class)->only(['create', 'store', 'destroy']);

    Route::resource('favorites', FavoriteController::class)->only(['index', 'store', 'destroy']);

    Route::resource('memos', ShoppingMemoController::class)->except(['edit']);
    Route::get('memos/create/recipe/{recipeId}', [ShoppingMemoController::class, 'createFromRecipe'])->name('memos.createFromRecipe');
    
    Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);
});