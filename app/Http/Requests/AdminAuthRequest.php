<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminAuthRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => ['required', 'email', 'max:255'],
            "password" => ['required', 'min:6', Password::min(6)->letters()->numbers()->symbols()],
            "remember" => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスが入力されていません',
            'email.email' => 'メールアドレスが正しくありません',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'password.required' => 'パスワードが入力されていません',
            'password.min' => '6文字以上で入力してください',
        ];
    }
}
