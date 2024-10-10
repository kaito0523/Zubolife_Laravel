<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('recipes.index')}}">レシピ一覧</a></li>
                <li><a href="{{ route('favorites.index')}}">お気に入り</a></li>
                <li><a href="{{ route('memos.index')}}">メモ一覧</a></li>
            </ul>
            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            <a href="{{ route('profile.index') }}">MYプロフィール</a>
            @else
            <a href="{{ route('login.index') }}">ログイン</a>
            <a href="{{ route('register.index') }}">登録</a>
            @endauth
        </nav>
    </header>
    <div>
        @yield('content')
    </div>
</body>
</html>