<?php

namespace App\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'cooking_time' => 'nullable|integer|min:0',
            'has_dishes' => 'required|boolean',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'string|max:255',
            'instructions' => 'required|array|min:1',
            'instructions.*' => 'required|string|max:1000',
            'reference_url' => 'nullable|url',
        ];
    }

    public function message()
    {
        //
    }
}
