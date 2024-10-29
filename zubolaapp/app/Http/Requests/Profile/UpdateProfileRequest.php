<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId, 
            'password' => 'nullable|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'そのメールアドレスはすでに使用されています',
            'password.min' => 'パスワードは６文字以上以上で入力してください',
        ];
    }
    

}
