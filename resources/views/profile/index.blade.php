@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ $user->name }}さんのプロフィール</h1>
    <p class="text-center">メールアドレス：{{ $user->email }}</p>
    <a href="{{ route('profile.edit') }}" class="text-[#FFAA85] hover:underline block text-center mb-5">プロフィールを編集</a>

    <div class="flex flex-col justify-center items-center mx-auto max-w-[960px] py-5 w-full">
        <div class="w-full flex-col flex-wrap justify-between gap-3 p-4">
            <h2 class="text-[#181411] tracking-light text-[32px] font-bold leading-tight text-center">あなたのレシピ一覧</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 w-full text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col bg-white px-4 py-3 w-full">
            @foreach($recipes as $recipe)
                <div class="flex items-center justify-between gap-4 bg-white px-4 py-3 w-full">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="flex items-center gap-4">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="object-cover h-14 w-24 rounded-lg">
                            @else
                                <div class="w-24 h-14 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                    <span>画像がありません</span>
                                </div>
                            @endif
                            <div class="flex flex-col justify-center">
                                <p class="text-[#181411] text-base font-medium leading-normal">{{ $recipe->title }}</p>
                            </div>
                        </a>
                    </div>

                    <div class="ml-auto">
                        <a href="{{ route('profile.editRecipe', $recipe->id) }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center rounded-xl h-8 px-4 bg-[#f4f2f0] text-[#181411] text-sm font-medium">
                            編集
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
