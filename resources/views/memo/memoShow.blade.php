@extends('layouts.app')

@section('content')

    <ul>
        <li>{{ $memo->title }}</li>
        <li>{{ $memo->content }}</li>
    </ul>
    <form action="{{ route('memos.destroy', $memo->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">削除</button>
    </form>

@endsection