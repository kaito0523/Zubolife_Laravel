<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('recipes/home', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipes/show/{id}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('recipes', [RecipeController::class, 'store'])->name('recipes.store');