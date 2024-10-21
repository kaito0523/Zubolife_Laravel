<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingMemo;
use App\Models\Recipe;
use App\Services\ShoppingMemoService;
use App\Http\Requests\Memo\StoreShoppingMemoRequest;
use App\Http\Requests\Memo\UpdateShoppingMemoRequest;
use Illuminate\Support\Facades\Auth;

class ShoppingMemoController extends Controller
{   
    protected $ShoppingMemoService;

    public function __construct(ShoppingMemoService $ShoppingMemoService)
    {
        $this->middleware('auth');
        $this->shoppingMemoService = $ShoppingMemoService;
    }

    public function index()
    {
        $memos = $this->shoppingMemoService->getUserMemos(Auth::id());
        return view('memo.memoList', compact('memos'));
    }

    public function show($id)
    {
        $memo = ShoppingMemo::findOrFail($id);
        $memos = Auth::user()->shoppingMemos()->latest()->get();
        return view('memo.memoShow', compact('memo', 'memos'));
    }

    public function create()
    {   
        $data = $this->shoppingMemoService->getCreateMemo(Auth::id());
        return view('memo.memoCreate', $data);
    }

    public function createFromRecipe($recipeId)
    {
        
            $recipe = Recipe::findOrFail($recipeId);
            $content = $recipe->ingredients->pluck('name')->toArray();
            $date = now()->format('m月d日');
            return view('memo.memoCreate', compact('recipe', 'content', 'date'));
    }

    public function store(StoreShoppingMemoRequest $request)
    {   
        $this->shoppingMemoService->createMemo($request->validated());

        return redirect()->route('memos.index')->with('message', 'メモを作成しました');

    }

    public function update(UpdateShoppingMemoRequest $request, $id)
    {
        $this->shoppingMemoService->updateMemo($request->validated(), $id);

        return redirect()->route('memos.index')->with('message', 'メモを更新しました');
    }

    public function destroy($id)
    {
        $this->shoppingMemoService->destroyMemo($id);

        return redirect()->route('memos.index');
    }
}
