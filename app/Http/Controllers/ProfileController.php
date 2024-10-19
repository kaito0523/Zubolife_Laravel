<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $recipes = $user->recipes()->latest()->get();

        return view('profile.index', compact('user', 'recipes'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, 
            'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'プロフィールを更新しました。');
    }

}
