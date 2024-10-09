<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingMemo;
use App\Models\Recipe;

class ShoppingMemoController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $Memos = ShoppingMemo::all();
        return view('memo.memoList', compact($Memos));
    }

    public function show($id)
    {
        $Memo = ShoppingMemo::findOrFail($id);
        return view('memo.memoShow', compact($Memo));
    }

    public function create($recipeId = null)
    {   
        $recipe = null;
        $content = '';
        if($recipeId){
            $recipe = Recipe::findOrFail($recipeId);
            $content = $recipe->ingredients;
        }
        return view('memo.memoCreate', compact('recipe', 'content'));
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

        return redirect()->route('MemoList')->with('message', 'メモを作成しました');

    }
}
