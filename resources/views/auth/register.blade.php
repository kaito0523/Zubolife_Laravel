@extends('layouts/app')

@section('content')

<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="name">名前：</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    @error('name')
        <div style="color:red;">{{ $message }}</div>  
    @enderror
    <label for="email">メールアドレス：</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    @error('email')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <label for="password">パスワード：</label>
    <input type="password" name="password" id="password" required>
    @error('password')
        <div style="color:red;">{{ $message }}</div>
    @enderror
    <button type="submit">登録</button>
</form>

@endsection
