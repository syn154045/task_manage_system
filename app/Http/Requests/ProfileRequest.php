<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
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
        $rules = [];
        $optionalRules = [
            "name" => ['required', 'max:255'],
            "email" => ['required', 'email', 'max:255'],
            "password_current" => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, $this->user()->password)) {
                        $fail('現在のパスワードが正しくありません');
                    }
                },
            ],
            "password" => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, $this->user()->password)) {
                        $fail('現在のパスワードと異なるものを設定してください');
                    }
                },
                'min:6',
                Password::min(6)->letters()->numbers()->symbols(),
                'confirmed'
            ],
            "password_confirm" => ['required']
        ];

        foreach ($optionalRules as $field => $fieldRules) {
            if ($this->has($field)) {
                $rules[$field] = $fieldRules;
            }
        };

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '名前が入力されていません',
            'name.max' => '名前は255文字以内で入力してください',
            'email.required' => 'メールアドレスが入力されていません',
            'email.email' => 'メールアドレスが正しくありません',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'password_current.required' => '現在のパスワードが入力されていません',
            'password.required' => 'パスワードが入力されていません',
            'password.min' => '6文字以上で入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
            'new_password_confirmation' => '新しいパスワード（確認用）',
        ];
    }
}
