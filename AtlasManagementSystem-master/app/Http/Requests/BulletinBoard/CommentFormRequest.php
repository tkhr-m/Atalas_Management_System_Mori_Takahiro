<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class CommentFormRequest extends FormRequest
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
            'comment' => 'required|max:250|string',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => '必須項目です。',
            'comment.max' => '250以内で入力して下さい。',
            'comment.string' => '文字のみ有効です。',
        ];
    }
}
