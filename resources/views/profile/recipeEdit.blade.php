@extends('layouts.app')

@section('content')
<div>
    <h1>レシピ編集</h1>
    <form action="{{ route('profile.updateRecipe', $recipe->id) }}" mathod="POST">
        @csrf
        @method('PATCH')
        <label for="title">料理名</label>
        <input type="text" name="title" id="title" value="{{ old('title', $recipe->title) }}" required>
        <label for=""></label>
        <label for="description">説明</label>
        <input type="text" id="description" name="description" value="{{ old('description', $recipe->description) }}" required>

        <label for="image">画像：</label>
        @if($recipe->image)
            <div>
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="現在の画像" style="max-width: 200px;">
            </div>
        @endif
        <input type="file" id="image" name="image">

        <label for="ingredients">材料</label>
        <textarea name="ingredients" id="ingredients" cols="30" rows="10">{{ old('ingredients', $recipe->ingredients) }}</textarea>

        <label for="instructions">作り方</label>
        <textarea name="instructions" id="instructions" cols="30" rows="10">{{ old('instruction', $recipe->instructions) }}</textarea>

        <label for="reference_url">参考にしたもの</label>
        <input type="url" name="reference_url" id="reference_url" value="{{ old('reference_url', $recipe->reference_url) }}">
    </form>
    <div class="flex justify-end pr-4">
        <form action="{{ route('profile.destroyRecipe', $recipe->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')" class="text-red-500 hover:underline">
                レシピを削除
            </button>
        </form>
    </div>
</div>
@endsection