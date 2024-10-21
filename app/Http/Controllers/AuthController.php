<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Http\Requests\Auth\StoreLoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerIndex()
    {
        return view('auth.register');
    }

    public function registerStore(StoreRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], //モデルでハッシュ済み
        ]);

        Auth::login($user);

        return redirect()->route('recipes.index');
    }

    public function loginIndex()
    {
        return view('auth.login');
    }

    public function loginStore(StoreLoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('recipes.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('recipes.index');
    }
}
