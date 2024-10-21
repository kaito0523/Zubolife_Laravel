<!DOCTYPE html>
<html lang="en">
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
<body class="flex items-center justify-center min-h-screen bg-[#FCFAF9]">
    <div class="max-w-md w-full px-6 py-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-12 text-center">ログイン</h1>
        <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
            @csrf
    
            <div>
                <label for="email" class="block text-lg font-semibold mb-2">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('email')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div>
                <label for="password" class="block text-lg font-semibold mb-2">パスワード</label>
                <input type="password" id="password" name="password" required
                    class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('password')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="text-center">
                <button type="submit" class="text-center py-4 mb-4 px-16 font-bold rounded-xl text-orange-500 border-4 border-orange-500 shadow-[3px_3px_0px_theme(colors.orange.500)] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white">
                    ログイン
                </button>
            </div>
        </form>
    </div>
</body>
</html>