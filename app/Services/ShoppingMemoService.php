<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\ShoppingMemo;


class ShoppingMemoService 
{   
    public function getUserMemos($userId)
    {
        return ShoppingMemo::where('user_id', $userId)->latest()->get();
    }

    public function getCreateMemo()
    {
        $date = now()->format('m月d日');
        $content = '';
        
        return compact('date', 'content');
    }

    public function createMemo($data)
    {
        $Memo = ShoppingMemo::create([
            'content' => $data['content'],
            'title' => $data['title'],
            'user_id' => auth()->id(),
        ]);
    }

    public function updateMemo($id, $data)
    {
        $memo = ShoppingMemo::findOrFail($id);
        $memo->title = $data['title'];
        $memo->content = $data['content'];
        $memo->save();

        return $memo;
    }

    public function destroyMemo($id)
    {
        $memo = ShoppingMemo::findOrFail($id);

        if($memo->user_id !== auth()->id()){
            abort(403, 'レシピを削除する権限がありません');
        }

        $memo->delete();

        return $memo;
    }
}