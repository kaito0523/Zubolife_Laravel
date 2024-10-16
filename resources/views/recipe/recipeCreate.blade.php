@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-12 px-6">
    <h1 class="text-5xl font-bold mb-12 text-center">あなたのかんたんレシピを投稿する</h1>
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-lg font-semibold mb-2">料理名</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('title')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-lg font-semibold mb-2">説明</label>
            <input type="text" id="description" name="description" value="{{ old('description') }}" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('description')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex">
            <div>
                <label for="cooking_time" class="block text-lg font-semibold mb-2">調理時間（分）</label>
                <input type="number" name="cooking_time" id="cooking_time" value="{{ old('cooking_time', $recipe->cooking_time ?? '') }}" required
                class="border border-[#E0E0E0] rounded-lg p3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            </div>
            
            <div class="mx-10">
                <label for="has_dishes" class="block text-lg font-semibold mb-2">洗い物</label>
                <select name="has_dishes" id="has_dishes" class="border border-[#E0E0E0] rounded-lg p3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                    <option value="1" {{ old('has_dishes', $recipe->has_dishes ?? '') == 1 ? 'selected' : '' }}>あり</option>
                    <option value="0" {{ old('has_dishes', $recipe->has_dishes ?? '') == 0 ? 'selected' : '' }}>なし</option>
                </select>
            </div>

            <div>
                <label for="image" class="block text-lg font-semibold mb-2">画像</label>
                <input type="file" id="image" name="image"
                    class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('image')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div>
            <label for="ingredients" class="block text-lg font-semibold mb-2">材料</label>
            <div id="ingredients-container">
                @if(old('ingredients'))
                    @foreach(old('ingredients') as $ingredient)
                        <div class="ingredient-item flex items-center mb-2">
                            <input type="text" name="ingredients[]" value="{{ $ingredient }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-ingredient ml-2 text-red-500">✖</button>
                        </div>
                    @endforeach
                @elseif(isset($recipe) && is_array($recipe->ingredients))
                    @foreach($recipe->ingredients as $ingredient)
                        <div class="ingredient-item flex items-center mb-2">
                            <input type="text" name="ingredients[]" value="{{ $ingredient }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]" >
                            <button type="button" class="remove-ingredient ml-2 text-red-500">✖</button>
                        </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 5; $i++)
                        <div class="ingredient-item flex items-center mb-2">
                            <input type="text" name="ingredients[]" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-ingredient ml-2 text-red-500">✖</button>
                        </div>
                    @endfor
                @endif
            </div>
            <button type="button" id="add-ingredient" 
                class="mt-2 px-4 py-2 border-2 border-[#719bad] text-[#719bad] rounded-lg"><i class="fa-solid fa-plus"></i> 材料を追加</button>
            @error('ingredients')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>
        

        <div>
            <label class="block text-lg font-semibold mb-2">作り方</label>
            <div id="instructions-container">
                @if(old('instructions'))
                    @foreach(old('instructions') as $index => $instruction)
                        <div class="instruction-item flex items-center mb-2">
                            <span class="mr-2">{{ $index + 1 }}.</span>
                            <input type="text" name="instructions[]" value="{{ $instruction }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-instruction ml-2 text-red-500">✖</button>
                        </div>
                    @endforeach
                @elseif(isset($recipe) && is_array($recipe->instructions))
                    @foreach($recipe->instructions as $index => $instruction)
                        <div class="instruction-item flex items-center mb-2">
                            <span class="mr-2">{{ $index + 1 }}.</span>
                            <input type="text" name="instructions[]" value="{{ $instruction }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-instruction ml-2 text-red-500">✖</button>
                        </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 1; $i++)
                        <div class="instruction-item flex items-center mb-2">
                            <span class="mr-2">{{ $i + 1 }}.</span>
                            <input type="text" name="instructions[]" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-instruction ml-2 text-red-500">✖</button>
                        </div>
                    @endfor
                @endif
            </div>
            <button type="button" id="add-instruction" 
                class="mt-2 px-4 py-2 border-2 border-[#719bad] text-[#719bad] rounded-lg"><i class="fa-solid fa-plus"></i> 手順を追加</button>
            @error('instructions')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="reference_url" class="flex text-lg font-semibold mb-2">参考にした動画やサイトのURL<div class="text-[#ADADAD]">(任意)</div></label>
            <input type="url" name="reference_url" id="reference_url" value="{{ old('reference_url') }}"
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('reference_url')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="text-center py-4 mb-4 px-16 font-bold rounded-xl text-[#FFAA85] border-4 border-[#FFAA85] shadow-[3px_3px_0px_#FFAA85] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white">
                レシピを作成
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addIngredientButton = document.getElementById('add-ingredient');
        const ingredientsContainer = document.getElementById('ingredients-container');

        addIngredientButton.addEventListener('click', function () {
            const ingredientItem = document.createElement('div');
            ingredientItem.classList.add('ingredient-item', 'flex', 'items-center', 'mb-2');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'ingredients[]';
            input.placeholder = '材料を入力';
            input.className = 'w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]';

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-ingredient ml-2 text-red-500';
            removeButton.textContent = '✖';

            ingredientItem.appendChild(input);
            ingredientItem.appendChild(removeButton);
            ingredientsContainer.appendChild(ingredientItem);

            input.focus();
        });

        ingredientsContainer.addEventListener('click', function (e) {
            if (e.target && e.target.matches('button.remove-ingredient')) {
                e.target.parentElement.remove();
            }
        });

        const addInstructionButton = document.getElementById('add-instruction');
        const instructionsContainer = document.getElementById('instructions-container');

        addInstructionButton.addEventListener('click', function () {
            const instructionItem = document.createElement('div');
            instructionItem.classList.add('instruction-item', 'flex', 'items-center', 'mb-2');

            // 手順番号を表示する <span> 要素を作成
            const stepNumber = document.createElement('span');
            stepNumber.classList.add('mr-2');
            stepNumber.textContent = ''; // 番号は後で更新

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'instructions[]';
            input.className = 'w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]';

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-instruction ml-2 text-red-500';
            removeButton.textContent = '✖';

            // 手順番号、入力フィールド、削除ボタンを追加
            instructionItem.appendChild(stepNumber);
            instructionItem.appendChild(input);
            instructionItem.appendChild(removeButton);
            instructionsContainer.appendChild(instructionItem);

            input.focus();
            updateInstructionNumbers();
        });

        instructionsContainer.addEventListener('click', function (e) {
            if (e.target && e.target.matches('button.remove-instruction')) {
                e.target.parentElement.remove();
                updateInstructionNumbers(); // 手順番号を更新
            }
        });

        function updateInstructionNumbers() {
            const instructionItems = instructionsContainer.querySelectorAll('.instruction-item');
            instructionItems.forEach((item, index) => {
                const stepNumber = item.querySelector('span');
                if (stepNumber) {
                    stepNumber.textContent = `${index + 1}.`;
                }
            });
        }

        // ページ読み込み時に手順番号を更新（必要に応じて）
        updateInstructionNumbers();
    });

</script>
@endsection