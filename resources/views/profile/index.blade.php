@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $user->name }}さんのプロフィール</h1>
    <p>メールアドレス：{{ $user->email }}</p>
    <a href="{{ route('profile.edit') }}">プロフィールを編集</a>

    <h2>あなたのレシピ一覧</h2>
    @if(session('success'))
        <div>{{ session('success')}}</div>
    @endif
    <ul>
        @foreach($recipes as $recipe)
        <li>
            <strong>{{ $recipe->title }}</strong>
            <img src="{{ $recipe->image }}" alt="">
            <a href="{{ route('profile.editRecipe') }}">編集</a>
            <form action="{{ route('profile.destroyRecipe') }}">
                @csrf
                <button type="submit" onclick="return confirm('本当に削除しますか？')">レシピを削除</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
@endsection
