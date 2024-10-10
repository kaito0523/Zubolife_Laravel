@extends('layouts.app')

@section('content')
    <h1>hello</h1>
    <ul>
        @foreach($favorites as $favorite)
            <li>
                <a href="{{ route('recipes.show', $favorite->recipe->id) }}" style="text-decoration: none; color: inherit;">
                    @if($favorite->recipe->image)
                        <img src="{{ asset('storage/' . $favorite->recipe->image) }}" alt="{{ $favorite->recipe->title }}" style="max-width: 200px;">
                    @else
                        <span>画像がありません</span>
                    @endif
                
                    <h2>{{ $favorite->recipe->title }}</h2>
                    <p>{{ $favorite->recipe->description }}</p>
                </a>
            </li>
        @endforeach
    </ul>
@endsection