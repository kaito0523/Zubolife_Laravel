@extends('layouts.memo')

@section('content')
<div class="max-w-5xl mx-auto mt-12 h-screen flex flex-col shadow-xl">
    <div class="flex-grow flex">
        <!-- 左側のメモ一覧 -->
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
            <form id="auto-save-form">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700"></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $memo->title) }}" class="mt-1 font-bold text-2xl block w-full p-2 rounded-md" oninput="autoSave()">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700"></label>
                    <textarea name="content" id="content" rows="20" class="resize-none mt-1 block w-full p-2 rounded-md" oninput="autoSave()">{{ old('content', $memo->content) }}</textarea>
                </div>

                <p id="save-status" class="text-sm text-gray-500"></p>
            </form>

            <form action="{{ route('memos.destroy', $memo->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">メモを削除</button>
            </form>
        </div>
    </div>
</div>

<script>
function autoSave() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const saveStatus = document.getElementById('save-status');

    const memoId = {{ $memo->id }};

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PATCH');
    formData.append('title', title);
    formData.append('content', content);

    fetch(`/memos/${memoId}`, { 
        method: 'POST',
        body: formData,
    })
    .catch(error => {
        saveStatus.textContent = "エラーが発生しました。";
    });
}
</script>
@endsection