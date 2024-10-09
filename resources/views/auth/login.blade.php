@extends('layouts.app')

@section('content')

<form action="{{ route('login') }}" method="POST">
    @csrf
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
    <button type="submit">ログイン</button>
</form>

@endsection