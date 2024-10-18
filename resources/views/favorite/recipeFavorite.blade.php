@extends('layouts.favorite')

@section('content')
    <div class="flex gap-20 justify-center my-7 p-14 mx-20 bg-[]">
        <h1 class="text-6xl font-bold font-heading text-[#424242] [text-shadow:_2px_2px_4px_rgb(0_0_0_/_15%)]">あなたのお気に入りレシピ<i class="fa-solid fa-star"></i></h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-20 px-10 rounded-lg bg-[] ">
        @foreach($favorites as $favorite)
        <div class="bg-[#FFFFFF] my-10 rounded-lg border border-[#E0E0E0] overflow-hidden transform transition hover:-translate-y-6 hover:scale-105 hover:shadow-lg"
            style="box-shadow: 0 4px 10px rgba(170, 170, 170, 0.5);">
            <a href="{{ route('recipes.show', $favorite->recipe->id) }}" class="flex flex-col h-full relative">
                @if($favorite->recipe->image)
                    <div class="relative">
                        <!-- タグを写真の上に配置 -->
                        <div class="absolute top-2 left-0 right-0 flex justify-center space-x-2 z-10">
                            @if(!$favorite->recipe->has_dishes)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">洗い物なし!</span>
                            @endif
                            @if($favorite->recipe->cooking_time !== null && $favorite->recipe->cooking_time <= 10)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">10分以内</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 3)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料3つ</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 2)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料2つ</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 1)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料1つ</span>
                            @endif
                        </div>
                        <img src="{{ asset('storage/' . $favorite->recipe->image) }}" alt="{{ $favorite->recipe->title }}" class="w-full h-48 object-cover rounded-t-lg">
                    </div>
                @else
                    <div class="relative">
                        <div class="absolute top-2 left-0 right-0 flex justify-center space-x-2 z-10">
                            @if(!$favorite->recipe->has_dishes)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">洗い物なし</span>
                            @endif
                            @if($favorite->recipe->cooking_time !== null && $favorite->recipe->cooking_time <= 10)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">10分以内</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 3)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">材料3つ</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 2)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">材料2つ</span>
                            @endif
                            @if($favorite->recipe->ingredients->count() == 1)
                                <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">材料1つ</span>
                            @endif
                        </div>
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-lg">
                            <span>画像がありません</span>
                        </div>
                    </div>
                @endif
                <div class="p-4 flex-1 flex flex-col">
                    <div class="flex">
                        <p class="flex pr-4 text-sm text-gray-500">{{ $favorite->recipe->updated_at->format('Y/m/d') }}</p>
                        <p class="flex text-sm text-gray-500 mb-2">調理時間：{{ $favorite->recipe->cooking_time }}分</p>
                    </div>
                    <h2 class="text-xl text-[#622d18] font-bold mb-2">{{ $favorite->recipe->title }}</h2>
                    <p class="text-sm text-[#6c3524] font-md mb-2 line-clamp-2">{{ $favorite->recipe->description }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection