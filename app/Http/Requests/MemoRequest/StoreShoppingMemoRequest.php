<?php

namespace App\Http\Requests\MemoRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreShoppingMemoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です',
            'content.required' => '何か記入してください',
        ];
    }
}
