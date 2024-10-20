<?php

namespace App\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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

    public function messages()
    {
        return [
            'title.required' => '料理名を入力してください',
            'title.string' => '料理名は文字列のみ入力してください',
            'title.max' => '料理名は48文字以内で入力してください',

            'image.file' => '画像はファイル形式でアップロードしてください',
            'image.mimes' => '画像はjpeg、png、jpgのいずれかの形式でアップロードしてください',
            'image.max' => '画像は2MB以下でアップロードしてください',

            'description.required' => '説明を入力してください',
            'description.string' => '説明は文字列で入力してください',
            'description.max' => '説明は288文字以内で入力してください',

            'cooking_time.required' => '調理時間を入力してください',
            'cooking_time.integer' => '調理時間は整数で入力してください',
            'cooking_time.min' => '調理時間は0以上で入力してください',
            'cooking_time.max' => '調理時間は500以内で入力してください',

            'has_dishes.required' => '洗い物の有無を選択してください',
            'has_dishes.boolean' => '洗い物の有無は真偽値でなければなりません',

            'ingredients.required' => '材料を1つ以上入力してください',
            'ingredients.min' => '材料は1つ以上必要です',
            'ingredients.*.string' => '各材料は文字列でなければなりません',
            'ingredients.*.max' => '各材料は35文字以内で入力してください',

            'instructions.required' => '手順を1つ以上入力してください',
            'instructions.min' => '手順は1つ以上必要です',
            'instructions.*.string' => '各手順は文字列でなければなりません',
            'instructions.*.max' => '各手順は299文字以内で入力してください',

            'reference_url.url' => '参照URLは有効なURL形式でなければなりません',
        ];
    }
}
