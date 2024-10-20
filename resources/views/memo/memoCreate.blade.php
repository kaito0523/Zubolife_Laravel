@extends('layouts.memo')

@section('content')
<div>
    <div class="max-w-5xl mx-auto mt-12 h-screen shadow-xl">
        <div class="pl-4 bg-[#FFFFFF] p-6 rounded-lg h-full flex-grow">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('memos.store') }}" method="POST">
                @csrf
                @if($content)
                <div class="mb-4 border-b">
                    <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $date . "の買い物メモ")}}" class="mt-1 font-bold text-2xl block w-full p-2 rounded-md">
                </div>

                <div class="mb-4 border rounded-lg">
                    <label for="content" class="block text-sm font-medium text-gray-700"></label>
                    <textarea name="content" id="content" rows="20" class="resize-none mt-1 block w-full p-2 rounded-md" required>{{ old('content', implode("\n", $content)) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">メモを保存</button>
                @else
                <div class="mb-4 border-b">
                    <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title')}}" class="mt-1 font-bold text-2xl block w-full p-2 rounded-md">
                </div>

                <div class="mb-4 border rounded-lg">
                    <label for="content" class="block text-sm font-medium text-gray-700"></label>
                    <textarea name="content" id="content" rows="20" class="resize-none mt-1 block w-full p-2 rounded-md" required>{{ old('content') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">メモを保存</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection