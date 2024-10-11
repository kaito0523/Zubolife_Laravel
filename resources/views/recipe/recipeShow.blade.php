@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-4 mx-20 mt-12 px-10">
        <div class="w-full md:w-1/2">
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-100 object-cover mb-4 shadow-lg shadow-[#D3D3D3]">
            @else
                <span>画像がありません</span>
            @endif
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="inline-block text-3xl font-bold mb-4 border-b-2 border-[#FFAA85]">{{ $recipe->title }}</h1>
            <p class="mb-4">{{ $recipe->description }}</p>
            <h2 class="inline-block mb-2 text-2xl font-bold border-b-2 border-[#FFAA85]">材料<i class="fa-solid fa-carrot text-color-[#FFAA85]"></i></h2>
            <ul class="mb-4 bg-[#F7F7F7]">
                @foreach(preg_split('/\r\n|\r|\n/', $recipe->ingredients) as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach
            </ul>
            <div class="mt-4 flex gap-4 justify-center">
                @auth
                    @if(Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists())
                        <form action="{{ route('favorites.delete', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#E59400] border-4 border-[#E59400] shadow-[5px_5px_0px_#E59400] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                                お気に入りから削除
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $recipe->id) }}" method="POST">
                            @csrf
                            <button type='submit' class="text-center py-4 px-8 font-bold rounded-xl text-[#FFAA85] border-4 border-[#FFAA85] shadow-[5px_5px_0px_#FFAA85] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                                お気に入りに追加
                            </button>
                        </form>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-center py-4 px-8 font-bold rounded-xl text-[#FFAA85] border-4 border-[#FFAA85] shadow-[3px_3px_0px_#FFAA85] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                        お気に入りに追加
                    </a>
                @endguest
                <a href="{{ route('memos.createFromRecipe', ['recipeId' => $recipe->id]) }}" class="text-center py-4 px-8 ml-10 font-bold rounded-xl text-[#5A9BD5] border-4 border-[#5A9BD5] shadow-[3px_3px_0px_#5A9BD5] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white whitespace-nowrap">
                    材料をメモを追加
                </a>
            </div>
        </div>
    </div>
    <div class="mx-20 mt-4 px-10">
        <h2 class="text-2xl font-bold">作り方<i class="fa-solid fa-fire-burner"></i></h2>
        <p class="mb-4 bg-[#F7F7F7]">{{ $recipe->instructions }}</p>
        <h2>参考URL</h2>
        <a href="{{ $recipe->reference_url }}" class="text-lg font-semibold">{{ $recipe->reference_url }}</a>
    </div>
@endsection
