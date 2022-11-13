<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Models\Users\Subjects;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView()
    {
        $subjects = Subjects::all();
        return view('auth.register.register', compact('subjects'));
    }

    public function registerPost(Request $request)
    {
        $rules = [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'under_name_kana' => 'required|string|regex:/\A[ァ-ヴー]+\z/u|max:30',
            'mail_address' => 'required|email|max:100|unique:users,mail',
            'sex' => 'required|numeric|between:0,2',
            'old_year' => 'required|numeric|between:1985,2010',
            'old_month' => 'required|numeric|between:1,12',
            'old_day' => 'required|numeric|between:1,31',
            'role' => 'required|numeric|between:0,3',
            'password' => 'required|between:8,30|confirmed',
        ];

        $messages = [
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
            'old_month.numeric' => '月を選択して下さい',
            'old_month.between' => '月を選択して下さい',
            'old_day.required' => '必須項目です。',
            'old_day.numeric' => '日を選択して下さい',
            'old_day.between' => '日を選択して下さい',
            'role.required' => '必須項目です。',
            'role.numeric' => '役職を選択して下さい。',
            'role.between' => '役職を選択して下さい。',
            'password.required' => '必須項目です。',
            'password.between' => '8〜30の間で入力して下さい。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->route('registerView')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try{
            $old_year = $request->old_year;
            $old_month = $request->old_month;
            $old_day = $request->old_day;
            $data = $old_year . '-' . $old_month . '-' . $old_day;
            $birth_day = date('Y-m-d', strtotime($data));
            $subjects = $request->subject;

            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password)
            ]);
            $user = User::findOrFail($user_get->id);
            $user->subjects()->attach($subjects);
            DB::commit();
            return view('auth.login.login');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('loginView');
        }
    }

}
