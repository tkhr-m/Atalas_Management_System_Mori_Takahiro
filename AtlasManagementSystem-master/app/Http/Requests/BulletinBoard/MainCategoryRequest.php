<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_category_name' => 'required|max:100|string|unique:main_categories,main_category',
        ];
    }

    public function messages()
    {
        return [
            'main_category_name.required' => '必須項目です。',
            'main_category_name.max' => '100以内で入力して下さい。',
            'main_category_name.string' => '文字のみ有効です。',
            'main_category_name.unique' => 'このカテゴリー名はすでに使われています。',
        ];
    }
}
