@extends('layouts.recipe')

@section('content')
    <div class="my-6 mx-20 flex items-center p-10">
        <div class="relative group">
            <button type="button" id="filter-button" class="px-4 py-2 mx-6 bg-white text-[#6c3524] border border-[#6c3524] rounded-lg">食材から絞り込む</button>
            <div id="filter-options" class="hidden group-hover:block fixed top-10 left-10 w-1/2 h-auto bg-white border border-white rounded-lg shadow-xl z-50 overflow-auto">
                <form action="{{ route('recipes.index') }}" method="GET" class="p-4">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pr-4">
                        <div>
                            <input type="checkbox" name="no_dishes" value="キャベツ" class="mx-1">
                            <label>洗い物なし</label>
                        </div>
                        <div>
                            <input type="checkbox" name="cooking_quick" value="トマト" class="mx-1">
                            <label>10分以内でできる</label>
                        </div>
                        <div>
                            <input type="checkbox" name="ingredients_few" value="玉ねぎ" class="mx-1">
                            <label>材料3つ以内</label>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">野菜</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="キャベツ"><label>キャベツ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="トマト"><label>トマト</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="玉ねぎ"><label>玉ねぎ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="レタス"><label>レタス</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="じゃがいも"><label>じゃがいも</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="にんじん"><label>にんじん</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ブロッコリー"><label>ブロッコリー</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ピーマン"><label>ピーマン</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="きゅうり"><label>きゅうり</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ほうれん草"><label>ほうれん草</label></div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">果物</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="りんご"><label>りんご</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="バナナ"><label>バナナ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="みかん"><label>みかん</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="いちご"><label>いちご</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ぶどう"><label>ぶどう</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="レモン"><label>レモン</label></div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">肉類</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="鶏肉"><label>鶏肉</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="豚肉"><label>豚肉</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="牛肉"><label>牛肉</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ベーコン"><label>ベーコン</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ハム"><label>ハム</label></div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">魚介類</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="鮭"><label>鮭</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="まぐろ"><label>まぐろ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="いか"><label>いか</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="エビ"><label>エビ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="かに"><label>かに</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="あさり"><label>あさり</label></div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">調味料</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="塩"><label>塩</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="醤油"><label>醤油</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="みりん"><label>みりん</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="酒"><label>酒</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="砂糖"><label>砂糖</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="味噌"><label>味噌</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="酢"><label>酢</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="マヨネーズ"><label>マヨネーズ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ケチャップ"><label>ケチャップ</label></div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold">その他の食材</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div><input type="checkbox" name="ingredients[]" value="米"><label>米</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="パスタ"><label>パスタ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="パン"><label>パン</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="チーズ"><label>チーズ</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="卵"><label>卵</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="牛乳"><label>牛乳</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="バター"><label>バター</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="ヨーグルト"><label>ヨーグルト</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="豆腐"><label>豆腐</label></div>
                                <div><input type="checkbox" name="ingredients[]" value="納豆"><label>納豆</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg">検索</button>
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('recipes.index') }}" method="GET" class="flex-grow relative mx-10">
            <input type="text" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="料理名や食材名で検索する" class="w-full p-4 pr-12 border border-[#F1ECE6] bg-[#F1ECE6] rounded-lg placeholder-[#7F6042] text-[#7F6042] focus:outline-none focus:border-[#6c3524]" style="height: 70px;">
            <button type="submit" class="absolute right-0 top-0 mt-2 mr-2 px-4 py-2"><i class="fa-solid text-[#7F6042] text-3xl mb-10 fa-magnifying-glass"></i></button>
        </form>
    </div>

    </div>

    <div class="flex">
        @if(isset($query) || !empty($ingredientNames))
            <h2 class="text-5xl flex font-bold mx-20 pl-20 my-4">
                @if(isset($query))
                    "{{ $query }}" の検索結果
                @endif
                @if(!empty($ingredientNames))
                    @if(isset($query)) + @endif
                    "{{ implode(', ', array_filter($ingredientNames)) }}"を使ったレシピ
                @endif
            </h2>
        @else
            <h2 class="text-5xl flex font-bold mx-20 pl-20 my-4 border-b-4]">お手軽レシピ一覧</h2>
            <a href="{{ route('recipes.create') }}" class="pb-8">
                <div class="flex px-20 py-4 mx-20 bg-white text-orange-500 text-lg border-4 border-orange-500 rounded-xl font-bold shadow-[3px_3px_0px_theme(colors.orange.500)] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                    あなたのかんたんレシピを投稿する
                </div>
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12 mx-20 px-10">
        @if($recipes->isEmpty())
        <div class="my-20 w-auto pl-10">
            <p class="text-xl font-bold">該当するレシピが見つかりませんでした。</p>
        </div>
        @else
        @foreach($recipes as $recipe)
            <div class="bg-[#FFFFFF] my-10 rounded-lg border border-[#E0E0E0] overflow-hidden transform transition hover:-translate-y-6 hover:scale-105 hover:shadow-lg"
                style="box-shadow: 0 4px 10px rgba(170, 170, 170, 0.5);">
                <a href="{{ route('recipes.show', $recipe->id) }}" class="flex flex-col h-full relative">
                    @if($recipe->image)
                        <div class="relative">
                            <!-- タグを写真の上に配置 -->
                            <div class="absolute top-2 left-0 right-0 flex justify-center space-x-2 z-10">
                                @if(!$recipe->has_dishes)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">洗い物なし!</span>
                                @endif
                                @if($recipe->cooking_time !== null && $recipe->cooking_time <= 10)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">10分以内</span>
                                @endif
                                @if($recipe->ingredients->count() == 3)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料3つ</span>
                                @endif
                                @if($recipe->ingredients->count() == 2)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料2つ</span>
                                @endif
                                @if($recipe->ingredients->count() == 1)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-white rounded-md px-2 py-1 text-sm">材料1つ</span>
                                @endif
                            </div>
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover rounded-t-lg">
                        </div>
                    @else
                        <div class="relative">
                            <div class="absolute top-2 left-0 right-0 flex justify-center space-x-2 z-10">
                                @if(!$recipe->has_dishes)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">洗い物なし</span>
                                @endif
                                @if($recipe->cooking_time !== null && $recipe->cooking_time <= 10)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">10分以内</span>
                                @endif
                                @if($recipe->ingredients->count() == 3)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">材料3つ</span>
                                @endif
                                @if($recipe->ingredients->count() == 2)
                                    <span class="block border-2 border-orange-500 text-orange-500 bg-[#F1ECE6] rounded-md px-2 py-1 text-sm">材料2つ</span>
                                @endif
                                @if($recipe->ingredients->count() == 1)
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
                            <p class="flex pr-4 text-sm text-gray-500">{{ $recipe->updated_at->format('Y/m/d') }}</p>
                            <p class="flex text-sm text-gray-500 mb-2">調理時間：{{ $recipe->cooking_time }}分</p>
                        </div>
                        <h2 class="text-xl text-[#622d18] font-bold mb-2 line-clamp-2">{{ $recipe->title }}</h2>
                        <p class="text-sm text-[#6c3524] font-md mb-2 line-clamp-2">{{ $recipe->description }}</p>
                    </div>
                </a>
            </div>
        @endforeach
        @endif
    </div>

    <script>
        const filterButton = document.getElementById('filter-button');
        const filterOptions = document.getElementById('filter-options');

        filterButton.addEventListener('mouseover', function() {
            filterOptions.classList.remove('hidden');
        });

        filterOptions.addEventListener('mouseleave', function() {
            filterOptions.classList.add('hidden');
        });
    </script>
@endsection