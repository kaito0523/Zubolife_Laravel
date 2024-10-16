<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{   
    public function index(Request $request)
{
    $query = $request->input('query');

    if ($query) {
        $recipes = Recipe::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhereJsonContains('ingredients', 'LIKE', "%{$query}%")
            ->get();
    } else {
        $recipes = Recipe::all();
    }

    return view('recipe.recipeList', compact('recipes', 'query'));
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
            'ingredients.*' => 'required|string|max:255',
            'instructions' => 'required|array|min:1',
            'instructions.*' => 'required|string|max:1000',
            'reference_url' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }
        Recipe::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'cooking_time' => $request->cooking_time,
            'has_dishes' => $request->has_dishes,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'reference_url' => $request->reference_url,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('recipes.index');
    }
}
