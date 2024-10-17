@extends('layouts.memo')

@section('content')
<div>
    <div class="max-w-5xl mx-auto mt-12 h-screen shadow-xl">
        <div class="pl-4 bg-[#FFFFFF] p-6 rounded-lg h-full flex-grow">
            <form action="{{ route('memos.store') }}" method="POST">
                @csrf
                @if($content)
                <div class="mb-4 border-b">
                    <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $date . "の買い物メモ")}}" class="mt-1 font-bold text-2xl block w-full p-2 rounded-md">
                    @error('title')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 border rounded-lg">
                    <label for="content" class="block text-sm font-medium text-gray-700"></label>
                    <textarea name="content" id="content" rows="20" class="resize-none mt-1 block w-full p-2 rounded-md" required>{{ old('content', $content) }}</textarea>
                    @error('content')
                        <div>{{ $massage }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">メモを保存</button>
                @else
                <div class="mb-4 border-b">
                    <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title')}}" class="mt-1 font-bold text-2xl block w-full p-2 rounded-md">
                    @error('title')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 border rounded-lg">
                    <label for="content" class="block text-sm font-medium text-gray-700"></label>
                    <textarea name="content" id="content" rows="20" class="resize-none mt-1 block w-full p-2 rounded-md" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div>{{ $massage }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">メモを保存</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection