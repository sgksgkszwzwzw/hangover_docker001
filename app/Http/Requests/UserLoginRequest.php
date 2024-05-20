<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'メールアドレスを入力してください',
            'email.email'=>'メールアドレスの形式を変更してください',
            'password.required'=>'パスワードを入力してください',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('mypage.mypage'); // ログイン後のリダイレクト先を指定
        }

        return back()->withErrors(['email' => 'メールアドレス・パスワードに不備があります']); // ログイン画面に戻る
    }
}