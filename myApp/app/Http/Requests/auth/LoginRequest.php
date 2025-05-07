<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'account_name' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).+$/'
            ],
        ];
    }
    public function messages(): array
    {
        return [
            '*.required' => 'Thông tin đăng nhập không đúng!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa và một ký tự đặc biệt!',
        ];
    }

}
