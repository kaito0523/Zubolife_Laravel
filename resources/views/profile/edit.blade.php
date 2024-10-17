@extends('layouts.app')

@section('content')
    <h1>プロフィール編集</h1>
    <form action="{{ route('profile.update')}}" method="POST">
        @csrf
        @method('PATCH')
        <label for="name">名前：</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
            <div style="color:red;">{{ $message }}</div>  
        @enderror
        <label for="email">メールアドレス：</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <label for="password">パスワード：</label>
        <input type="password" name="password" id="password">
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <button type="submit">変更する</button>
    </form>
@endsection