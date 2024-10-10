@extends('layouts.app')

@section('content')

<form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">タイトル</label>
    <input type="text" id="title" name="title" value="{{ old('title') }}" required>

    <label for="description">説明</label>
    <input type="text" id="description" name="description" value="{{ old('description') }}" required>

    <label for="image">画像</label>
    <input type="file" id="image" name="image">

    <label for="ingredients">材料</label>
    <textarea name="ingredients" id="ingredients" cols="30" rows="10">{{ old('ingredients') }}</textarea>

    <label for="instructions">作り方</label>
    <textarea name="instructions" id="instructions" cols="30" rows="10">{{ old('instruction') }}</textarea>

    <label for="reference_url">参考にしたもの</label>
    <input type="url" name="reference_url" id="reference_url" value="{{ old('reference_url') }}">

    <button type="submit" class="btn btn-primary">レシピを作成</button>
</form>

@endsection