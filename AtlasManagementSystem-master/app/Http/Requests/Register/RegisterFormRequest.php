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

public function getValidatorInstance(){
    $old_year = $this->input('old_year');
    $old_month = $this->input('old_month');
    $old_day = $this->input('old_day');
    $birthday = $old_year.'-'.$old_month.'-'.$old_day;
    $this->merge(['birthday' => $birthday]);

    return parent::getValidatorInstance();
}

    public function rules()
    {
       return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'under_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'mail_address' => 'required|email|max:100|unique:users,mail_address',
            'sex' => 'required|numeric|between:1,3',
            'birthday' => 'required|date|after_or_equal:2000-01-01|before_or_equal:now',
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
            'birthday.required' => '必須項目です。',
            'birthday.date' => '生年月日を選択して下さい。',
            'birthday.after_or_equal' => '2000年1月1日以降の日付を選択して下さい。',
            'birthday.before_or_equal' => '今日以前の日付を選択して下さい。',
            'role.required' => '必須項目です。',
            'role.numeric' => '役職を選択して下さい。',
            'role.between' => '役職を選択して下さい。',
            'password.required' => '必須項目です。',
            'password.between' => '8〜30の間で入力して下さい。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
