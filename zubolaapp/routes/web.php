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
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [RecipeController::class, 'index']);
Route::resource('recipes', RecipeController::class); //Controller内で個別にミドルウェアを適応させています

Route::middleware('auth')->group(function () {
    Route::resource('favorites', FavoriteController::class)->only(['index', 'destroy']);
    Route::post('favorites/{recipeId}', [FavoriteController::class, 'store'])->name('favorites.store');

    Route::resource('memos', ShoppingMemoController::class)->except(['edit']);
    Route::get('memos/create/recipe/{recipeId}', [ShoppingMemoController::class, 'createFromRecipe'])->name('memos.createFromRecipe');

    Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);
});