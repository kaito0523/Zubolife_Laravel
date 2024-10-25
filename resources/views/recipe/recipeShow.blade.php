@extends('layouts.recipe')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 mx-4 md:mx-20 mt-10 md:mt-20 px-4 md:px-10">
        <div class="w-full md:w-1/2">
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-96 md:h-100 object-cover mb-4 shadow-lg shadow-[#D3D3D3]">
            @else
                <span>画像がありません</span>
            @endif
            <div class="flex flex-wrap gap-2 mb-4">
                <p class="text-[#6c3524] font-bold mr-4">タグ</p>
                @if(!$recipe->has_dishes)
                    <span class="inline-block bg-[#F1ECE6] text-[#6c3524] text-xs md:text-sm font-semibold px-2.5 py-0.5 rounded">洗い物なし</span>
                @endif
                @if($recipe->cooking_time !== null && $recipe->cooking_time <= 10)
                    <span class="inline-block bg-[#F1ECE6] text-[#6c3524] text-xs md:text-sm font-semibold px-2.5 py-0.5 rounded">10分以内でできる</span>
                @endif
                @if($recipe->ingredients->count() == 3)
                    <span class="inline-block bg-[#F1ECE6] text-[#6c3524] text-xs md:text-sm font-semibold px-2.5 py-0.5 rounded">材料3つ</span>
                @endif
                @if($recipe->ingredients->count() == 2)
                    <span class="inline-block bg-[#F1ECE6] text-[#6c3524] text-xs md:text-sm font-semibold px-2.5 py-0.5 rounded">材料2つ</span>
                @endif
                @if($recipe->ingredients->count() == 1)
                    <span class="inline-block bg-[#F1ECE6] text-[#6c3524] text-xs md:text-sm font-semibold px-2.5 py-0.5 rounded">材料1つ</span>
                @endif
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="text-2xl md:text-4xl text-[#622d18] font-black mb-4 md:mb-6">{{ $recipe->title }}</h1>
            <p class="mb-4 md:mb-6 text-[#6c3524]">{{ $recipe->description }}</p>
            <p class="mb-6 md:mb-12 text-[#6c3524]">調理時間：{{ $recipe->cooking_time }}分</p>
            <h2 class="text-xl md:text-3xl font-bold text-[#622d18] mb-4 md:mb-6">材料<i class="fa-solid fa-carrot text-[#622d18]"></i></h2>
            <ul class="mb-6 md:mb-12 bg-[#F1ECE6] text-[#6c3524] font-semibold p-4">
                @foreach($recipe->ingredients as $ingredient)
                    <li class="mb-0.5">{{ $ingredient->name }}</li>
                @endforeach
            </ul>
            <div class="mt-6 md:mt-8 flex flex-col md:flex-row gap-4 md:gap-8 items-center justify-center">
                @auth
                    @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                        <form action="{{ route('favorites.destroy', $recipe->id) }}" method="POST" class="w-full flex justify-center">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="text-center py-2 md:py-4 px-4 md:px-8 font-bold rounded-xl text-[#ef857d] border-4 border-[#ef857d] shadow-[3px_3px_0px_#ef857d] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white w-full flex justify-center">
                                お気に入りから削除
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $recipe->id) }}" method="POST" class="w-full flex justify-center">
                            @csrf
                            <button type='submit' class="text-center py-2 md:py-4 px-4 md:px-8 font-bold rounded-xl text-[#ebd842] border-4 border-[#ebd842] shadow-[3px_3px_0px_#ebd842] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white w-full flex justify-center">
                                お気に入りに追加
                            </button>
                        </form>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-center py-2 md:py-4 px-4 md:px-8 font-bold rounded-xl text-[#ebd842] border-4 border-[#ebd842] shadow-[3px_3px_0px_#ebd842] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white w-full flex justify-center">
                        お気に入りに追加
                    </a>
                @endguest
                <a href="{{ route('memos.createFromRecipe', ['recipeId' => $recipe->id]) }}" class="text-center py-2 md:py-4 px-4 md:px-8 font-bold rounded-xl text-[#719bad] border-4 border-[#719bad] shadow-[3px_3px_0px_#719bad] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white w-full flex justify-center">
                    材料をメモを追加
                </a>
            </div>
            
        </div>
    </div>
    <div class="mx-4 md:mx-20 mt-4 md:mt-2 px-4 md:px-10">
        <h2 class="text-xl md:text-3xl font-bold mb-4 text-[#622d18]">作り方<i class="fa-solid fa-fire-burner"></i></h2>
        <ul class="bg-[#F1ECE6] p-4">
            @foreach($recipe->instructions as $instruction)
                <li class="mb-4 text-[#6c3524]"><strong class="text-lg">{{ $loop->iteration }}.</strong> {{ $instruction }}</li>
            @endforeach
        </ul>
        <h2 class="text-xl md:text-2xl font-bold mt-6 mb-4 text-[#622d18]">参考URL</h2>
        @if($recipe->reference_url)
            <a href="{{ $recipe->reference_url }}" class="text-sm md:text-lg font-semibold text-blue-600 hover:underline">{{ $recipe->reference_url }}</a>
        @else
            <p>参考URLはありません</p>
        @endif
    </div>
@endsection
