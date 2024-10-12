@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 px-8">
        <table class="table-auto w-full border-separate border-spacing-0">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border rounded-tl-lg">タイトル</th>
                    <th class="px-4 py-2 border">メモ</th>
                    <th class="px-4 py-2 border">最終更新日時</th>
                    <th class="px-4 py-2 border rounded-tr-lg"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($memos as $memo)
                    <tr>
                        <td class="border px-4 py-2 {{ $loop->last ? 'rounded-bl-lg' : '' }}">{{ $memo->title }}</td>
                        <td class="border px-4 py-2 line-clamp-1 ">{{ $memo->content }}</td>
                        <td class="border px-4 py-2">{{ $memo->updated_at->format('Y-m-d H:i') }}</td>
                        <td class="border px-4 py-2 {{ $loop->last ? 'rounded-br-lg' : '' }}">
                            <form action="{{ route('memos.destroy', $memo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border px-4 py-2">保存されたメモはありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('memos.create') }}">メモを作成する</a>
@endsection