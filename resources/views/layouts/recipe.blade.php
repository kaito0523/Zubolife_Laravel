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
            },
            fontFamily: {
                kosugi: ['"Kosugi Maru"', 'sans-serif'],
                sans: ['"Noto Sans JP"', 'sans-serif'],
                heading: ['"Roboto"', 'sans-serif'],
                serif: ['"Noto Serif"', 'serif'],
                merriweather: ['"Merriweather"', 'serif'],
                Arial: ["Arial"],
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
<body class="font-sans text-[#424242] bg-[#FCFAF9]">
    <header class="bg-[#FFFFFF] sticky top-0 border-b-2 border-[#dcdddd] z-50">
        <nav class="p-5">
            <div class="container mx-auto flex justify-between items-center">
                <div class="font-bold text-2xl text-[#424242] [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                    <h1>Zubolife</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <ul class="flex space-x-6 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)] mr-8">
                        <li class="relative group">
                            <a href="{{ route('recipes.index') }}" 
                                class="block px-4 pb-1 pt-2 transform text-lg transition hover:-translate-y-1">
                                レシピ一覧 <i class="fa-solid fa-utensils"></i>
                                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#FFC076] scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ route('favorites.index') }}" 
                                class="block px-4 py-2 text-lg pb-1 pt-2 transform transition hover:-translate-y-1">
                                お気に入り <i class="fa-solid fa-star"></i>
                                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#ebd842] scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                            </a>
                        </li>
                        <li class="relative group">
                            <a href="{{ route('memos.index') }}" 
                                class="block px-4 py-2 transform pb-1 pt-2 text-lg transition hover:-translate-y-1">
                                メモ一覧 <i class="fa-solid fa-file-pen"></i>
                                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#0481A2] scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
                            </a>
                        </li>
                    </ul>
                    
                    @auth
                    <div class="flex items-center space-x-6 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)] ">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="font-md mr-5 transition hover:-translate-y-1  hover:text-[#FFAA85]">ログアウト<i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                        <a href="{{ route('profile.index') }}" 
                            class="{{ Request::routeIs('profile.index') ? 'border-b-2 border-[#FFAA85]' : '' }} transition hover:-translate-y-1 hover:text-[#FFAA85]">
                            MYプロフィール<i class="fa-solid fa-id-card-clip"></i>
                        </a>
                    </div>
                    @else
                    <div class="flex items-center space-x-6 font-bold [text-shadow:_2px_2px_4px_rgb(0_0_0_/_10%)]">
                        <a href="{{ route('login') }}" 
                            class="transition hover:-translate-y-1 hover:text-[#FFAA85]">
                            ログイン<i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                        <a href="{{ route('register.index') }}" 
                            class="transition hover:-translate-y-1 hover:text-[#FFAA85]">
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