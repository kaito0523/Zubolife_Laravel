<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Services\RecipeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{   
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
    }

    public function index(Request $request)
    {   
        $ingredientNames = $request->input('ingredients'); 
        $query = $request->input('query');
        $no_dishes = $request->input('no_dishes');
        $cooking_quick = $request->input('cooking_quick');
        $ingredients_few = $request->input('ingredients_few');

        $recipes = $this->recipeService->getFilteredRecipes($ingredientNames, $query, $no_dishes, $cooking_quick, $ingredients_few);

        return view('recipe.recipeList', compact('recipes', 'query', 'ingredientNames'));
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

        $this->recipeService->createRecipe($request->all());

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        
        $this->recipeService->destroyRecipe($id);

        return redirect()->route('profile.index')->with('success', 'レシピを削除しました');
    }
}
