<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>メモを作成する</h1>

        {{-- エラーメッセージの表示 --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- メモ作成フォーム --}}
        <form action="{{ route('memos.store') }}" method="POST">
            @csrf
            
            {{-- タイトル欄 --}}
            <div class="form-group">
                <label for="title">メモのタイトル:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            {{-- コンテンツ欄 --}}
            <div class="form-group">
                <label for="content">メモの内容:</label>
                <textarea class="form-control" name="content" id="content" rows="4" required>{{ old('content', $content)}}</textarea>
            </div>

            {{-- メモの保存ボタン --}}
            <button type="submit" class="btn btn-primary">メモを保存</button>
        </form>
    </div>
</body>
</html>