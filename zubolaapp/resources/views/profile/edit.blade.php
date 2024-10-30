@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#FCFAF9]">
    <div class="max-w-md w-full px-6 py-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-12 text-center">プロフィール編集</h1>
        <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="block text-lg font-semibold mb-2">名前</label>
                <input type="name" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('name')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-lg font-semibold mb-2">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
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
                    編集
                </button>
            </div>
        </form>
    </div>
</div>
@endsection