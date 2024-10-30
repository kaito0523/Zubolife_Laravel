@extends('layouts.app')

@section('content')
<div class="container">
    <h1>レシピを編集する</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- タイトル -->
        <div>
            <label for="title" class="block text-2xl font-semibold mb-2">料理名</label>
            <input type="text" id="title" name="title" value="{{ old('title', $recipe->title) }}" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('title')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- 説明 -->
        <div>
            <label for="description" class="block text-2xl font-semibold mb-2">説明</label>
            <textarea id="description" name="description" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">{{ old('description', $recipe->description) }}</textarea>
            @error('description')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- 調理時間と洗い物 -->
        <div class="flex flex-wrap mb-12 space-x-4">
            <div class="flex-1 min-w-[200px]">
                <label for="cooking_time" class="block text-2xl font-semibold mb-2">調理時間（分）</label>
                <input type="number" name="cooking_time" id="cooking_time" value="{{ old('cooking_time', $recipe->cooking_time) }}" required
                    class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('cooking_time')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-1 min-w-[200px]">
                <label for="has_dishes" class="block text-2xl font-semibold mb-2">洗い物</label>
                <select name="has_dishes" id="has_dishes" class="w-full bg-white border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]" required>
                    <option value="1" {{ old('has_dishes', $recipe->has_dishes) == 1 ? 'selected' : '' }}>あり</option>
                    <option value="0" {{ old('has_dishes', $recipe->has_dishes) == 0 ? 'selected' : '' }}>なし</option>
                </select>
                @error('has_dishes')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-1 min-w-[200px]">
                <label for="image" class="block text-2xl font-semibold mb-2">画像</label>
                @if ($recipe->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($recipe->image) }}" alt="Recipe Image" width="200">
                    </div>
                @endif
                <input type="file" id="image" name="image"
                    class="w-full border border-[#E0E0E0] bg-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                @error('image')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 材料 -->
        <div>
            <label for="ingredients" class="block text-2xl font-semibold mb-2">材料  (入力例："しょうゆ：大さじ１")</label>
            <div id="ingredients-container">
                @if(old('ingredients'))
                    @foreach(old('ingredients') as $ingredient)
                        <div class="ingredient-item flex items-center mb-2">
                            <input type="text" name="ingredients[]" value="{{ $ingredient }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                            <button type="button" class="remove-ingredient ml-2 text-red-500">✖</button>
                        </div>
                    @endforeach
                @elseif(isset($recipe) && is_array($recipe->ingredients->pluck('name')->toArray()))
                    @foreach($recipe->ingredients->pluck('name') as $ingredient)
                        <div class="ingredient-item flex items-center mb-2">
                            <input type="text" name="ingredients[]" value="{{ $ingredient }}" 
                                class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
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

        <!-- 作り方 -->
        <div>
            <label class="block text-2xl font-semibold mb-2">作り方</label>
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
                    <div class="instruction-item flex items-center mb-2">
                        <span class="mr-2">1.</span>
                        <input type="text" name="instructions[]" 
                            class="w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
                        <button type="button" class="remove-instruction ml-2 text-red-500">✖</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-instruction" 
                class="mt-2 px-4 py-2 border-2 border-[#719bad] text-[#719bad] rounded-lg"><i class="fa-solid fa-plus"></i> 手順を追加</button>
            @error('instructions')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- 参考URL -->
        <div>
            <label for="reference_url" class="flex text-lg font-semibold mb-2">参考にした動画やサイトのURL<div class="text-[#ADADAD]">(任意)</div></label>
            <input type="url" name="reference_url" id="reference_url" value="{{ old('reference_url', $recipe->reference_url) }}"
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('reference_url')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="text-center py-4 mb-4 px-16 font-bold rounded-xl text-[#FFAA85] border-4 border-[#FFAA85] shadow-[3px_3px_0px_#FFAA85] transition duration-300 ease-in-out hover:shadow-none hover:translate-x-1 hover:translate-y-1 z-50 bg-white">
                レシピを更新
            </button>
        </div>
    </form>
</div>

<!-- JavaScript for dynamic add/remove -->
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

            const stepNumber = document.createElement('span');
            stepNumber.classList.add('mr-2');
            stepNumber.textContent = ''; // Step numbers will be updated below

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'instructions[]';
            input.placeholder = '作り方を入力';
            input.className = 'w-full border border-[#E0E0E0] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]';

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-instruction ml-2 text-red-500';
            removeButton.textContent = '✖';

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
                updateInstructionNumbers();
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

        updateInstructionNumbers();
    });
</script>
@endsection
