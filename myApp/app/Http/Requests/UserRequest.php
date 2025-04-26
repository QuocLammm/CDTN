<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'role_id' =>'required|integer|in:1,3',
            'full_name' => 'required|string|regex:/^[\p{L}\s]{3,255}$/u',

            'address'=>'required|string|max:255',
            'phone' => [
                'required',
                'numeric',
                'digits_between:10,11'
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],

            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'gender'=>'required|in:Male,Female',
            'email'=> 'required|email|unique:users,Email',
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Vui lòng chọn quyền hạng!',
            'role_id.in' => 'Quyền hạng bạn chọn không phù hợp!',

            'full_name.required' => 'Vui lòng nhập họ và tên!',
            'full_name.regex' => 'Tên chỉ chứa chữ thường và chữ hoa có dấu, tối thiểu 3 đến 255 ký tự!',

            'address.required' => 'Vui lòng nhập địa chỉ!',
            'address.max' => 'Địa chỉ tối đa 255 ký tự!',

            'phone.required' => 'Vui lòng nhập số điện thoại!',
            'phone.numeric' => 'Số điện thoại chỉ được chứa số!',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 số!',

            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự!',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.',

            'date_of_birth.required' => 'Vui lòng nhập ngày sinh!',
            'date_of_birth.date' => 'Ngày sinh không hợp lệ!',
            'date_of_birth.date_format' => 'Ngày sinh phải có định dạng yyyy-mm-dd (VD: 2000-01-01).',

            'gender.required' => 'Vui lòng chọn giới tính!',
            'gender.in' => 'Vui lòng chọn Male hoặc Female!',

            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại!',
        ];
    }

}
