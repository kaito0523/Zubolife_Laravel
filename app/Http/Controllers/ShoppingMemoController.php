<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingMemo;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class ShoppingMemoController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memos = Auth::user()->shoppingMemos()->latest()->get();
        return view('memo.memoList', compact('memos'));
    }

    public function show($id)
    {
        $memo = ShoppingMemo::findOrFail($id);
        return view('memo.memoShow', compact('memo'));
    }

    public function create()
    {   
        $date = now()->format('m月d日');
        $content = '';
        return view('memo.memoCreate', compact('content', 'date'));
    }

    public function createFromRecipe($recipeId)
    {
        
            $recipe = Recipe::findOrFail($recipeId);
            $content = $recipe->ingredients;
            $date = now()->format('m月d日');
            return view('memo.memoCreate', compact('recipe', 'content', 'date'));
    }

    public function store(Request $request)
    {   
        
        $request->validate([ 
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        ShoppingMemo::create([
            'content' => $request->content,
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('memos.index')->with('message', 'メモを作成しました');

    }

    public function destroy($id)
    {
        $memo = ShoppingMemo::findOrFail($id);

        if($memo->user_id !== Auth::id()){
            abort(403, 'レシピを削除する権限がありません');
        }

        $memo->delete();
        return redirect()->route('memos.index');
    }
}
