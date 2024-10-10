@extends('layouts.app')

@section('content')
    <ul>
        
        @forelse($memos as $memo)
        <a href="{{ route('memos.show', $memo->id)}}">
            <li>
                {{ $memo->title }}
                {{ $memo->content }}
            </li>
        </a>
        @empty
            <h2>保存されたメモはありません</h2>
        @endforelse
    </ul>
    <a href="{{ route('memos.create')}}">メモを作成する</a>
@endsection