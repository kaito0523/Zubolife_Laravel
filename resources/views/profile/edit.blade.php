@extends('layouts.app')

@section('content')
<div>
    <h1>レシピ編集</h1>
    <form action="{{ route('profile.updateRecipe', $recipe->id) }}" mathod="POST">
        @csrf
        <label for="title">料理名</label>
        <input type="text" name="title" id="title" value="{{ old('title', $request->title) }}">
    </form>
</div>