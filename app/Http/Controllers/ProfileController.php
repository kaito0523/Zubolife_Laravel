<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $recipes = $user->recipes()->latest()->get();

        return view('profile.index', compact('user', 'recipes'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, 
            'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'プロフィールを更新しました。');
    }

    public function editRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);

        if($recipe->user_id !== Auth::id()){
            abort(403, 'このレシピを編集する権限がありません');
        }

        return view('profile.recipeEdit', compact('recipe'));

    }

    public function updateRecipe(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        if($recipe->user_id !== Auth::id()){
            abort(403, 'このレシピを更新する権限がありません');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'reference_url' => 'nullable|url',
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
            $recipe->image = $imagePath;
        }
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->instruction = $request->instruction;
        $recipe->reference_url = $request->reference_url;
        $recipe->save();

        return redirect()->route('profile.index')->with('success', 'レシピを更新しました');
    }

    public function destroyRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);

        if($recipe->user_id !== Auth::id()){
            abort(403, 'レシピを削除する権限がありません');
        }

        $recipe->delete();

        return redirect()->route('profile.index')->with('success', 'レシピを削除しました');
    }
}
