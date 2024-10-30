<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Services\RecipeService;
use App\Http\Requests\Recipe\StoreRecipeRequest;
use App\Http\Requests\Recipe\UpdateRecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{   
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
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

    public function store(StoreRecipeRequest $request)
    {
        $this->recipeService->createRecipe($request->validated());

        return redirect()->route('recipes.index')->with('message', 'レシピを作成しました');
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        return view('recipe.recipeEdit', compact('recipe'));
    }

    public function update(UpdateRecipeRequest $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $this->recipeService->updateRecipe($recipe, $request->validated());

        return redirect()->route('recipes.show', $recipe->id)->with('message', 'レシピを更新しました');
    }

    public function destroy($id)
    {
        
        $this->recipeService->destroyRecipe($id);

        return redirect()->route('profile.index')->with('success', 'レシピを削除しました');
    }
}
