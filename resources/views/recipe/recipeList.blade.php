@extends('layouts.app')

@section('content')
    <h1>hello</h1>
    <ul>
        @foreach($recipes as $recipe)
            <li>
                <a href="{{ route('recipes.show', $recipe->id) }}" style="text-decoration: none; color: inherit;">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" style="max-width: 200px;">
                    @else
                        <span>画像がありません</span>
                    @endif
                
                    <h2>{{ $recipe->title }}</h2>
                    <p>{{ $recipe->description }}</p>
                </a>
            </li>
        @endforeach
    </ul>
@endsection