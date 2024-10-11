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

        <div>
            <label for="image" class="block text-lg font-semibold mb-2">画像</label>
            <input type="file" id="image" name="image"
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85]">
            @error('image')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="ingredients" class="block text-lg font-semibold mb-2">材料</label>
            <textarea name="ingredients" id="ingredients" cols="30" rows="5" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85] bg-[#F7F7F7]" placeholder="材料:大さじ1 などと入力して材料1つずつで改行していただくと見やすくなります">{{ old('ingredients') }}</textarea>
            @error('ingredients')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="instructions" class="block text-lg font-semibold mb-2">作り方</label>
            <textarea name="instructions" id="instructions" cols="30" rows="5" required
                class="w-full border border-[#E0E0E0] rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#FFAA85] bg-[#F7F7F7]">{{ old('instructions') }}</textarea>
            @error('instructions')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="reference_url" class="block text-lg font-semibold mb-2">参考にした動画やサイトのURL(任意)</label>
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
@endsection