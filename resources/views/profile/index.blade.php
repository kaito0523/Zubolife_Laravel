@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-4xl py-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#181411] mb-4">{{ $user->name }}さんのプロフィール</h1>
            <p class="text-lg text-gray-600 mb-6">メールアドレス：{{ $user->email }}</p>
            <a href="{{ route('profile.edit') }}" class="text-[#FFAA85] hover:underline text-lg">プロフィールを編集</a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-[#181411] text-center mb-6">あなたのレシピ一覧</h2>
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif
            <div class="space-y-4">
                @foreach($recipes as $recipe)
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="flex items-center gap-4">
                                @if($recipe->image)
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="object-cover h-16 w-24 rounded-lg">
                                @else
                                    <div class="w-24 h-16 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                        <span>画像がありません</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-lg font-semibold text-[#181411]">{{ $recipe->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $recipe->updated_at->format('Y-m-d') }}</p>
                                </div>
                            </a>
                        </div>
                        <form action="{{ route('profile.destroyRecipe', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-[#E87B36] hover:bg-[#FFAA85] text-white text-sm font-medium py-2 px-4 rounded-lg shadow-md transition-colors duration-300">
                                レシピを削除
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
