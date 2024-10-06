<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {   
        $recipes = Recipe::all();
        return view('recipeList', ['recipes' => $recipes]);
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipeShow', ['recipe' => $recipe]);
    }

    public function create()
    {
        return view('recipeCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instruction' => 'required|string',
            'reference_url' => 'nullable|url',
            'user_id' => 'required|exists:users,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }
        Recipe::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instruction' => $request->instruction,
            'reference_url' => $request->reference_url,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('recipes.index');
    }
}
