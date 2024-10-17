<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{   
    public function index(Request $request)
    {   
        $ingredientNames = $request->input('ingredients'); // 選択された材料のID（配列）
        $query = $request->input('query'); // 検索キーワード

        $recipesQuery = Recipe::query();

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

        $recipes = $recipesQuery->get();

        $allIngredients = Ingredient::orderBy('name')->get();

        return view('recipe.recipeList', compact('recipes', 'query', 'ingredientNames', 'allIngredients'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipe.recipeShow', compact('recipe'));
    }

    public function create()
    {
        return view('recipe.recipeCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'cooking_time' => 'nullable|integer|min:0',
            'has_dishes' => 'required|boolean',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'string|max:255',
            'instructions' => 'required|array|min:1',
            'instructions.*' => 'required|string|max:1000',
            'reference_url' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }
        $recipe = Recipe::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'cooking_time' => $request->cooking_time,
            'has_dishes' => $request->has_dishes,
            'instructions' => $request->instructions,
            'reference_url' => $request->reference_url,
            'user_id' => auth()->id()
        ]);

        $ingredientIds = [];
        foreach ($request->ingredients as $ingredientName) {
            $ingredientName = trim($ingredientName);
            if ($ingredientName == '') {
                continue;
            }
            $ingredient = Ingredient::firstOrCreate(['name' => $ingredientName]);
            $ingredientIds[] = $ingredient->id;
        }

        $recipe->ingredients()->attach($ingredientIds);

        return redirect()->route('recipes.index');
    }
}
