<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingMemo;
use App\Models\Recipe;

class ShoppingMemoController extends Controller
{
    public function index()
    {
        $Memos = ShoppingMemo::all();
        return view('Memos.memoList', ['Memos' => $Memos]);
    }

    public function show($id)
    {
        $Memo = ShoppingMemo::findOrFail($id);
        return view('Memos.memoShow', ['Memo' => $Memo]);
    }

    public function create($recipeId = null)
    {   
        $recipe = null;
        if($recipeId){
            $recipe = Recipe::findOrFail($recipeId);
        }
        return view('Memos.memoCreate', ['recipe' => $recipe]);
    }

    public function store(Request $request)
    {   
        
        $request->validate([ 
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $request->ShoppingMemo::create([
            'content' => $request->content,
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('MemoList')->with('message', 'メモを作成しました');

    }
}
