<?php

namespace App\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:48',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string|max:288',
            'cooking_time' => 'required|integer|min:0|max:500',
            'has_dishes' => 'required|boolean',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'nullable|max:35',
            'instructions' => 'required|array|min:1',
            'instructions.*' => 'nullable|string|max:299',
            'reference_url' => 'nullable|url',
        ];
    }

    public function validationOption()
    {
        $this->merge([
            'ingredients' => array_filter($this->input('ingredients', []), function($value) {
                return !is_null($value) && $value !== '';
            }),
            'instructions' => array_filter($this->input('instructions', []), function($value) {
                return !is_null($value) && $value !== '';
            }),
        ]);
    }
}
