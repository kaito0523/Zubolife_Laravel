<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $favorites = Auth::user()->favorites()->with('recipe')->get();
        return view('favorite.recipeFavorite', ['favorites' => $favorites]);
    }

    public function store($recipeId)
    {
        $favorite = Recipe::findOrFail($recipeId);

        if(!Auth::user()->favorites()->where('recipe_id', $recipeId)->exists()){
            Auth::user()->favorites()->create(['recipe_id' => $recipeId]);
        }

        return back()->with('message', 'レシピをお気に入りに登録しました');
    }

    public function destroy($recipeId)
    {
        Auth::user()->favorites()->where('recipe_id', $recipeId)->delete();

        return back()->with('message', 'レシピをお気に入りから削除しました');
    }
}
