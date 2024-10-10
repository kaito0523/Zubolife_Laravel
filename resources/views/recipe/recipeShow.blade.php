@extends('layouts.app')

@section('content')
    <table>
        <ul>
            <li>{{ $recipe->title }}</li>
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" style="max-width: 200px;">
            @else
                <span>画像がありません</span>
            @endif
            <li>{{ $recipe->description }}</li>
            <li>{{ $recipe->ingredients }}</li>
            <li>{{ $recipe->instructions }}</li>
            <li>{{ $recipe->reference_url }}</li>
        </ul>
    </table>
        @auth
            @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                <form action="{{ route('favorites.delete', $recipe->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type='submit'>お気に入りから削除</button>
                </form>
            @else
                <form action="{{ route('favorites.store', $recipe->id) }}" method="POST">
                    @csrf
                    <button type='submit'>お気に入りに追加</button>
                </form>
            @endif
        @endauth
            @guest
                <a href="{{ route('login') }}">お気に入りに追加</a>
            @endguest
            <a href="{{ route('memos.createFromRecipe', ['recipeId' => $recipe->id]) }}" class="btn btn-primary">メモを追加</a>
@endsection