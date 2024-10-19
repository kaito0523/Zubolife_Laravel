<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeService
{
    public function getFilteredRecipes($ingredientNames, $query, $no_dishes, $cooking_quick, $ingredients_few)
    {
        $recipesQuery = Recipe::query();

        if($no_dishes){
            $recipesQuery->where('has_dishes', false);
        }

        if($cooking_quick){
            $recipesQuery->where('cooking_time', '<=', 10);
        }

        if($ingredients_few){
            $recipesQuery->whereHas('ingredients', function($q) {
                $q->select('ingredient_recipe.recipe_id')
                    ->groupBy('ingredient_recipe.recipe_id')
                    ->havingRaw('COUNT(ingredient_recipe.ingredient_id) <= 3');
        
            });
        }

        if ($query) {
            $recipesQuery->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhereHas('ingredients', function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                    });
            });
        }

        if (!empty($ingredientNames)) {
            $ingredientNamesFiltered = array_filter($ingredientNames);
            if(!empty($ingredientNamesFiltered)){
                $recipesQuery->whereHas('ingredients', function($q) use ($ingredientNamesFiltered) {
                    $q->whereIn('name', $ingredientNamesFiltered);
                }, '=', count($ingredientNamesFiltered));
            }
        }

        return $recipesQuery->get() ?? collect();
    }

    public function createRecipe($data)
    {
        $imagePath = null;
        if (isset($data['image'])){
            $imagePath = $data['image']->store('images', 'public');
        }
        $recipe = Recipe::create([
            'title' => $data['title'],
            'image' => $imagePath,
            'description' => $data['description'],
            'cooking_time' => $data['cooking_time'],
            'has_dishes' => $data['has_dishes'],
            'instructions' => $data['instructions'],
            'reference_url' => $data['reference_url'],
            'user_id' => auth()->id()
        ]);

        $ingredientIds = [];
        foreach ($data['ingredients'] as $ingredientName) {
            $ingredientName = trim($ingredientName);
            if ($ingredientName == '') {
                continue;
            }
            $ingredient = Ingredient::firstOrCreate(['name' => $ingredientName]);
            $ingredientIds[] = $ingredient->id;
        }

        $recipe->ingredients()->attach($ingredientIds);
    }

    public function destroyRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);

        if($recipe->user_id !== auth()->id()){
            abort(403, 'レシピを削除する権限がありません');
        }

        $recipe->delete();

        return true;
    }
}