<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    module.exports = {
        theme: {
            extend: {
            colors: {
                'custom-orange': '#FF7043',
            },
            fontFamily: {
                sans: ['"Kosugi Maru"', 'sans-serif'],
                serif: ['"Noto Serif"', 'serif'],
                merriweather: ['"Merriweather"', 'serif'],
            },
            },
        },
        variants: {
            extend: {
            decorationColor: ['hover'],
            },
        },
        plugins: [],
    }
    </script>
</head>
<body class="font-sans text-[#424242] bg-[#FFFFFF]">
    <header class="bg-[#FFFFFF] sticky top-0 border-b-2 border-[#dcdddd] z-50">
        <nav class="p-5">
            <div class="container mx-auto flex justify-between items-center">
                <div class="font-bold text-xl [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                    <h1>Zubolife</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <ul class="flex space-x-6 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                        <li>
                            <a href="{{ route('recipes.index') }}" 
                                class="block transform transition hover:-translate-y-1">
                                レシピ一覧 <i class="fa-solid fa-utensils"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('favorites.index') }}" 
                                class="border-b-2 border-[#ebd842]  block transform transition hover:-translate-y-1">
                                お気に入り <i class="fa-solid fa-star"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('memos.index') }}" 
                                class="block transform transition hover:-translate-y-1">
                                メモ一覧 <i class="fa-solid fa-file-pen"></i>
                            </a>
                        </li>
                    </ul>
                    @auth
                    <div class="flex items-center space-x-6 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="font-bold hover:text-gray-300">ログアウト</button>
                        </form>
                        <a href="{{ route('profile.index') }}" 
                            class="{{ Request::routeIs('profile.index') ? 'border-b-2 border-[#FFAA85]' : '' }} hover:text-[#FFAA85]">
                            MYプロフィール
                        </a>
                    </div>
                    @else
                    <div class="flex items-center space-x-4 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                        <a href="{{ route('login.index') }}" 
                            class="{{ Request::routeIs('login.index') ? 'border-b-2 border-[#FFAA85]' : '' }} hover:text-[#FFAA85]">
                            ログイン
                        </a>
                        <a href="{{ route('register.index') }}" 
                            class="{{ Request::routeIs('register.index') ? 'border-b-2 border-[#FFAA85]' : '' }} hover:text-[#FFAA85]">
                            登録
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <div>
        @yield('content')
    </div>
</body>
</html>