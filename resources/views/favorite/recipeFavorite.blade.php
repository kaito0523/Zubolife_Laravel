@extends('layouts.favorite')

@section('content')
    <div class="flex gap-20 justify-center my-7 p-14 mx-20 bg-[#FFFDF2]">
        <h1 class="text-6xl font-bold font-heading text-[#424242] [text-shadow:_2px_2px_4px_rgb(0_0_0_/_15%)]">あなたのお気に入りレシピ<i class="fa-solid fa-star"></i></h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-20 px-10 border-2 border-[#FFFDF2] rounded-lg bg-[#FFFDF2] ">
        @foreach($favorites as $favorite)
            <div class="my-10 rounded-lg border bg-[#FFFFFF] border-[#E0E0E0] overflow-hidden transform transition hover:-translate-y-6" 
                style="box-shadow: 0 4px 10px rgba(170, 170, 170, 0.5);"
                onmouseover="this.style.boxShadow='0 6px 12px ##E0E0E0';" 
                onmouseout="this.style.boxShadow='0 4px 10px rgba(170, 170, 170, 0.5)';">
                <a href="{{ route('recipes.show', $favorite->recipe->id) }}">
                    @if($favorite->recipe->image)
                        <img src="{{ asset('storage/' . $favorite->recipe->image) }}" alt="{{ $favorite->recipe->title }}" class="w-full h-48 object-cover rounded-t-lg">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-lg">
                            <span>画像がありません</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-xl text-[#622d18] font-bold mb-4">{{ $favorite->recipe->title }}</h2>
                        <p class="text-sm text-[#6c3524] line-clamp-2">{{ $favorite->recipe->description }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection