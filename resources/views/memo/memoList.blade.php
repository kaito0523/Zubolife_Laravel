@extends('layouts.memo')

@section('content')
<div class="max-w-5xl mx-auto mt-12 h-screen flex flex-col shadow-xl">
    <div class="flex-grow flex">
        <div class="w-1/3 pr-4 overflow-y-auto py-8 pl-8 border-2 border-[#F7F7F5] rounded-bl-xl rounded-tl-xl bg-[#F7F7F5] h-full">
            <a href="{{ route('memos.create') }}" class="block my-4 pl-5 text-blue-500">メモを作成する<i class="fa-solid fa-plus"></i></a>
            <ul class="m-2">
                @forelse($memos as $memo1)
                    <li class="py-2 p-4 transform transition hover:-translate-y-1 hover:scale-105 hover:shadow-lg">
                        <a href="{{ route('memos.show', $memo1->id) }}" class="block">
                            <h3 class="text-lg font-semibold line-clamp-1">{{ $memo1->title }}</h3>
                            <span class="text-xs text-gray-500">{{ $memo1->updated_at->format('Y-m-d H:i') }}</span>
                        </a>
                    </li>
                @empty
                    <li>保存されたメモはありません</li>
                @endforelse
            </ul>
        </div>

        <div class="w-2/3 pl-4 bg-[#FFFFFF] p-6 rounded-br-xl rounded-tr-xl h-full flex-grow">
            <div class="text-center mt-4 text-2xl font-bold">
                <h2><i class="fa-solid fa-left-long"></i>メモを選択してください</h2>
            </div>
        </div>
    </div>
</div>
@endsection