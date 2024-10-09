@extends('layouts.app')

@section('content')
    <h1>hello</h1>
    <ul>
        @foreach($recipes as $recipe)
            <li>{{ $recipe }}</li>
        @endforeach
    </ul>
@endsection