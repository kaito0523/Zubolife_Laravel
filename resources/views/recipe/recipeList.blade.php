@extends('layouts.recipe')

@section('content')
    <!-- 背景画像設定 -->
    <div class="my-6 mx-20 flex items-center p-10" style="background-image: url('{{ asset('storage/your-image-file-path.jpg') }}'); background-size: cover; background-position: center;">
        <div class="relative">
                <button type="button" id="filter-button" class="px-4 py-2 mr-4 bg-white text-[#6c3524] border border-[#6c3524] rounded-lg">食材から絞り込む</button>
                <div id="filter-options" class="hidden absolute mt-2 bg-white border border-gray-300 rounded-lg shadow-lg z-50 w-96 max-width-200">
                    <form action="{{ route('recipes.index') }}" method="GET" class="p-4">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pr-4 whitespace-nowrap auto-cols-auto">

                            <div>
                                <input type="checkbox" name="ingredients[]" value="キャベツ" class="mx-1">
                                <label>キャベツ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="トマト" class="mx-1">
                                <label>トマト</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="玉ねぎ" class="mx-1">
                                <label>玉ねぎ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="レタス" class="mx-1">
                                <label>レタス</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="じゃがいも" class="mx-1">
                                <label>じゃがいも</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="にんじん" class="mx-1">
                                <label>にんじん</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ブロッコリー" class="mx-1">
                                <label>ブロッコリー</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ピーマン" class="mx-1">
                                <label>ピーマン</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="きゅうり" class="mx-1">
                                <label>きゅうり</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ほうれん草" class="mx-1">
                                <label>ほうれん草</label>
                            </div>
                        
                            <!-- 果物類 -->
                            <div>
                                <input type="checkbox" name="ingredients[]" value="りんご" class="mx-1">
                                <label>りんご</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="バナナ" class="mx-1">
                                <label>バナナ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="みかん" class="mx-1">
                                <label>みかん</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="いちご" class="mx-1">
                                <label>いちご</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ぶどう" class="mx-1">
                                <label>ぶどう</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="レモン" class="mx-1">
                                <label>レモン</label>
                            </div>
                        
                            <!-- 肉類 -->
                            <div>
                                <input type="checkbox" name="ingredients[]" value="鶏肉" class="mx-1">
                                <label>鶏肉</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="豚肉" class="mx-1">
                                <label>豚肉</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="牛肉" class="mx-1">
                                <label>牛肉</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ベーコン" class="mx-1">
                                <label>ベーコン</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ハム" class="mx-1">
                                <label>ハム</label>
                            </div>
                            
                            <!-- 魚介類 -->
                            <div>
                                <input type="checkbox" name="ingredients[]" value="鮭" class="mx-1">
                                <label>鮭</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="まぐろ" class="mx-1">
                                <label>まぐろ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="いか" class="mx-1">
                                <label>いか</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="エビ" class="mx-1">
                                <label>エビ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="かに" class="mx-1">
                                <label>かに</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="あさり" class="mx-1">
                                <label>あさり</label>
                            </div>
                            
                            <!-- 調味料 -->
                            <div>
                                <input type="checkbox" name="ingredients[]" value="塩" class="mx-1">
                                <label>塩</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="醤油" class="mx-1">
                                <label>醤油</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="みりん" class="mx-1">
                                <label>みりん</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="酒" class="mx-1">
                                <label>酒</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="砂糖" class="mx-1">
                                <label>砂糖</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="味噌" class="mx-1">
                                <label>味噌</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="酢" class="mx-1">
                                <label>酢</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="マヨネーズ" class="mx-1">
                                <label>マヨネーズ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ケチャップ" class="mx-1">
                                <label>ケチャップ</label>
                            </div>
                        
                            <!-- その他の食材 -->
                            <div>
                                <input type="checkbox" name="ingredients[]" value="米" class="mx-1">
                                <label>米</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="パスタ" class="mx-1">
                                <label>パスタ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="パン" class="mx-1">
                                <label>パン</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="チーズ" class="mx-1">
                                <label>チーズ</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="卵" class="mx-1">
                                <label>卵</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="牛乳" class="mx-1">
                                <label>牛乳</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="バター" class="mx-1">
                                <label>バター</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="ヨーグルト" class="mx-1">
                                <label>ヨーグルト</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="豆腐" class="mx-1">
                                <label>豆腐</label>
                            </div>
                            <div>
                                <input type="checkbox" name="ingredients[]" value="納豆" class="mx-1">
                                <label>納豆</label>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg">検索</button>
                        </div>
                    </form>
                </div>                
            </div>
        <!-- 検索フォーム -->
        <form action="{{ route('recipes.index') }}" method="GET" class="flex-grow relative mx-10">
            <input type="text" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="料理名や食材名で検索する" class="w-full p-4 pr-12 border border-[#F1ECE6] bg-[#F1ECE6] rounded-lg placeholder-[#7F6042] text-[#7F6042] focus:outline-none focus:border-[#6c3524]" style="height: 70px;">
            <button type="submit" class="absolute right-0 top-0 mt-2 mr-2 px-4 py-2"><i class="fa-solid text-[#7F6042] text-3xl mb-10 fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- 検索結果の表示 -->
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
            <h2 class="text-5xl flex font-bold mx-20 pl-20 my-4">お手軽レシピ一覧</h2>
            <a href="{{ route('recipes.create') }}" class="pb-8">
                <div class="flex px-20 py-4 mx-20 bg-white text-[#FFC076] text-lg border-4 border-[#FFC076] rounded-xl font-bold shadow-[3px_3px_0px_#FFC076] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                    あなたのかんたんレシピを投稿する
                </div>
            </a>
        @endif
    </div>

    <!-- レシピカードのセクション -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-20 px-10">
        @if($recipes->isEmpty())
        <div class="my-20 w-auto pl-10">
            <p class="text-xl font-bold">該当するレシピが見つかりませんでした。</p>
        </div>
        @else
            @foreach($recipes as $recipe)
                <div class="bg-[#FFFFFF] my-10 rounded-lg border border-[#E0E0E0] overflow-hidden transform transition hover:-translate-y-6 hover:scale-105 hover:shadow-lg"
                    style="box-shadow: 0 4px 10px rgba(170, 170, 170, 0.5);">
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
                            <div class="flex">
                                @if(!$recipe->has_dishes)
                                <div class="flex">
                                    <span class="border border-[#622d18] rounded-md p-1 mx-1 my-2 text-[#622d18]">洗い物なし</span>
                                </div>
                                @endif
                                @if($recipe->cooking_time !== null && $recipe->cooking_time <= 10)
                                <div class="flex"> 
                                    <span class="border border-[#622d18] rounded-md p-1 mx-1 my-2 text-[#622d18]">10分以内でできる</span>
                                </div>
                                @endif
                            </div>
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