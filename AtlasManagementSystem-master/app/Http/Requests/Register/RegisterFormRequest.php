<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'under_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            'sex' => 'required|numeric|between:1,3',
            'old_year' => 'required|numeric|between:2000,now',
            'old_month' => 'required|numeric|between:1,12',
            'old_day' => 'required|numeric|between:1,31',
            'role' => 'required|numeric|between:1,4',
            'password' => 'required|between:8,30|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'over_name.required' => '必須項目です。',
            'over_name.string' => '文字を入力して下さい。',
            'over_name.max' => '10以内で入力して下さい。',
            'under_name.required' => '必須項目です。',
            'under_name.string' => '文字を入力して下さい。',
            'under_name.max' => '10以内で入力して下さい。',
            'over_name_kana.required' => '必須項目です。',
            'over_name_kana.string' => '文字を入力して下さい。',
            'over_name_kana.regex' => 'カタカナで入力して下さい。',
            'over_name_kana.max' => '30以内で入力して下さい。',
            'under_name_kana.required' => '必須項目です。',
            'under_name_kana.string' => '文字を入力して下さい。',
            'under_name_kana.regex' => 'カタカナで入力して下さい。',
            'under_name_kana.max' => '30以内で入力して下さい。',
            'mail_address.required' => '必須項目です。',
            'mail_address.email' => 'メールアドレス形式で入力して下さい。',
            'mail_address.max' => '100以内で入力して下さい。',
            'mail_address.unique' => 'このアドレスはすでに使われています。',
            'sex.required' => '必須項目です。',
            'sex.numeric' => '性別を選択して下さい。',
            'sex.between' => '性別を選択して下さい。',
            'old_year.required' => '必須項目です。',
            'old_year.numeric' => '年を選択して下さい。',
            'old_year.between' => '年を選択して下さい。',
            'old_month.required' => '必須項目です。',
            'old_month.numeric' => '月を選択して下さい。',
            'old_month.between' => '月を選択して下さい。',
            'old_day.required' => '必須項目です。',
            'old_day.numeric' => '日を選択して下さい。',
            'old_day.between' => '日を選択して下さい。',
            'role.required' => '必須項目です。',
            'role.numeric' => '役職を選択して下さい。',
            'role.between' => '役職を選択して下さい。',
            'password.required' => '必須項目です。',
            'password.between' => '8〜30の間で入力して下さい。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
