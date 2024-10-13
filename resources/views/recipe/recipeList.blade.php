@extends('layouts.recipe')

@section('content')
    <div class="flex gap-20 justify-center my-7 p-14 mx-20 border-2 border-[#FFFAF4] rounded-lg bg-[#FFFAF4]">
        <h1 class="text-6xl font-bold font-heading text-[#424242] [text-shadow:_2px_2px_3px_rgb(0_0_0_/_10%)]">
            お手軽かんたんレシピ！
            <i class="fa-solid fa-bowl-rice text-[#333333]"></i>
        </h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-20 px-10 border-2 border-[#FFFAF4] rounded-lg bg-[#FFFAF4] ">
        @foreach($recipes as $recipe)
            <div class="bg-[#FFFFFF] my-10 rounded-lg border border-[#E0E0E0] overflow-hidden transform transition hover:-translate-y-6 hover:scale-105 hover:shadow-lg"
                style="box-shadow: 0 4px 10px rgba(170, 170, 170, 0.5);"
                onmouseover="this.style.boxShadow='0 10px 12px #E0E0E0';"
                onmouseout="this.style.boxShadow='0 4px 10px rgba(170, 170, 170, 0.5)';">
                <a href="{{ route('recipes.show', $recipe->id) }}" class="flex flex-col h-full">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover rounded-t-lg">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-lg">
                            <span>画像がありません</span>
                        </div>
                    @endif
                    <div class="p-4 flex-1 flex flex-col">
                        <h2 class="text-xl text-[#622d18] font-bold mb-4 line-clamp-2">{{ $recipe->title }}</h2>
                        <p class="text-sm text-[#6c3524] line-clamp-2 flex-grow">{{ $recipe->description }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <a href="{{ route('recipes.create') }}">
        <div class="fixed bottom-8 right-8 block text-center w-30 py-4 px-8 font-bold rounded-xl text-[#FFAC65] border-4 border-[#FFAC65] shadow-[3px_3px_0px_#FFAC65] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white">
            <p>あなたのかんたんレシピを投稿する</p>
        </div>
    </a>
@endsection