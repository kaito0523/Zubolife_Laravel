@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 mx-20 mt-20 px-10">
        <div class="w-full md:w-1/2">
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-100 object-cover mb-4 shadow-lg shadow-[#D3D3D3]">
            @else
                <span>画像がありません</span>
            @endif
            <div class="tags mb-4">
                @if(!$recipe->has_dishes)
                    <span class="badge badge-success">洗い物なし</span>
                @endif
        
                @if($recipe->cooking_time !== null && $recipe->cooking_time <= 10)
                    <span class="badge badge-info">10分以内でできる</span>
                @endif
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="inline-block text-4xl text-[#622d18] font-black mb-6">{{ $recipe->title }}</h1>
            <p class="mb-6 text-[#6c3524]">{{ $recipe->description }}</p>
            <p class="mb-12 text-[#6c3524]">調理時間：{{ $recipe->cooking_time }}分</p>
            <h2 class="inline-block mb-6 text-3xl font-bold text-[#622d18]">材料<i class="fa-solid fa-carrot text-[#622d18]"></i></h2>
            <ul class="mb-12 bg-[#F1ECE6] text-[#6c3524] font-semibold">
                @foreach($recipe->ingredients as $ingredient)
                    <li class="mb-0.5">{{ $ingredient->name }}</li>
                @endforeach
            </ul>
            <div class="mt-8 flex gap-8 justify-center">
                @auth
                    @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                        <form action="{{ route('favorites.destroy', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#ef857d] border-4 border-[#ef857d] shadow-[5px_5px_0px_#ef857d] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                                お気に入りから削除
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $recipe->id) }}" method="POST">
                            @csrf
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#ebd842] border-4 border-[#ebd842] shadow-[3px_3px_0px_#ebd842] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                                お気に入りに追加
                            </button>
                        </form>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-center py-4 px-8 font-bold rounded-xl text-[#fcc800] border-4 border-[#fcc800] shadow-[3px_3px_0px_#fcc800] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                        お気に入りに追加
                    </a>
                @endguest
                <a href="{{ route('memos.createFromRecipe', ['recipeId' => $recipe->id]) }}" class="text-center py-4 px-8 ml-10 font-bold rounded-xl text-[#719bad] border-4 border-[#719bad] shadow-[3px_3px_0px_#719bad] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                    材料をメモを追加
                </a>
            </div>
        </div>
    </div>
    <div class="mx-20 mt-2 px-10">
        <h2 class="text-3xl font-bold mb-4 text-[#622d18]">作り方<i class="fa-solid fa-fire-burner"></i></h2>
        <ul class="bg-[#F1ECE6]">
            @foreach($recipe->instructions as $instruction)
                <li class="mb-6 text-[#6c3524]">{{ $loop->iteration }}.{{ $instruction }}</li>
            @endforeach
        </ul>
        <h2 class="text-2xl font-bold mb-4">参考URL</h2>
        @if($recipe->reference_url)
            <a href="{{ $recipe->reference_url }}" class="text-lg font-semibold">{{ $recipe->reference_url }}</a>
        @else
            <p>参考URLはありません</p>
        @endif
    </div>
@endsection
