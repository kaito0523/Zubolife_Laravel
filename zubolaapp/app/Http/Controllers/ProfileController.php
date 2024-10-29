<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
use App\Http\Requests\Profile\UpdateProfileRequest;
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

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if($validated['password']){
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'プロフィールを更新しました。');
    }

}
