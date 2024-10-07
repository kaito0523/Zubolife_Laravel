@extends('layouts.app')

@section('content')
    <table>
        <ul>
            <li>{{ $recipe->title }}</li>
            <li>{{ $recipe->image }}</li>
            <li>{{ $recipe->description }}</li>
            <li>{{ $recipe->ingredients }}</li>
            <li>{{ $recipe->instructions }}</li>
            <li>{{ $recipe->reference_url }}</li>
        </ul>
    </table>
    @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                <form action="{{ route('favorites.delete') $recipe->id }}">
                    @csrf
                    @method('DELETE')
                    <button type='submit'>お気に入りから削除</button>
                </form>
            @else
                <form action="{{ route('favorites.store') $recipe->id }}">
                    @csrf
                    <button type='submit'>お気に入りに追加</button>
                </form>
            @endif
            <a href="{{ route('memos.create', ['recipeId' => $recipe->id]) }}" class="btn btn-primary">メモを追加</a>
@endsection