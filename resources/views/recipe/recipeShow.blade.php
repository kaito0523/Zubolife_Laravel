@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 mx-20 mt-12 px-10">
        <div class="w-full md:w-1/2">
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-100 object-cover mb-4 shadow-lg shadow-[#D3D3D3]">
            @else
                <span>画像がありません</span>
            @endif
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="inline-block text-4xl font-black mb-6">{{ $recipe->title }}</h1>
            <p class="mb-12 ">{{ $recipe->description }}</p>
            <h2 class="inline-block mb-6 text-3xl font-bold">材料<i class="fa-solid fa-carrot text-color-[]"></i></h2>
            <ul class="mb-12 bg-[#F4F0E9] text-[#2C3E50] font-semibold">
                @foreach(preg_split('/\r\n|\r|\n/', $recipe->ingredients) as $ingredient)
                    <li class="mb-0.5">{{ $ingredient }}</li>
                @endforeach
            </ul>
            <div class="mt-8 flex gap-8 justify-center">
                @auth
                    @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                        <form action="{{ route('favorites.delete', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#ef857d] border-4 border-[#ef857d] shadow-[5px_5px_0px_#ef857d] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                                お気に入りから削除
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $recipe->id) }}" method="POST">
                            @csrf
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#E07A00] border-4 border-[#E07A00] shadow-[5px_5px_0px_#E07A00] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
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
        <h2 class="text-3xl font-bold mb-4">作り方<i class="fa-solid fa-fire-burner"></i></h2>
        <p class="mb-6 bg-[#F4F0E9]">{!! nl2br(e($recipe->instructions)) !!}</p>
        <h2 class="text-2xl font-bold mb-4">参考URL</h2>
        @if($recipe->reference_url)
            <a href="{{ $recipe->reference_url }}" class="text-lg font-semibold">{{ $recipe->reference_url }}</a>
        @else
            <p>参考URLはありません</p>
        @endif
    </div>
@endsection
