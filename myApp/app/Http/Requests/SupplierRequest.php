<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'SupplierName'=>'required|string|regex:/^[a-zA-Z]$/',
            'Phone'=>'required|numeric|digits_between:10,11',
            'ContactName'=>'required|string|max:255|regex:/^[a-zA-Z]$/',
            'Address'=>'required|string|max:255',
            'Email'=>'required|email',
        ];
    }
    public function messages(): array{
        return [
            'SupplierName.required' =>'Vui lòng nhập họ và tên!',
            'SupplierName.regex' => 'Tên không chứa số và ký tự đặc biệt!',
            'Address.required' => 'Vui lòng nhập địa chỉ!',
            'Phone.required' => 'Vui lòng nhập số điện thoại!',
            'Phone.numeric' => 'Số điện thoại chỉ là số!',
            'Phone.digits_between' =>'Số điện thoại phải từ 10 đến 12 số!',
            'ContactName.required' => 'Vui lòng nhập tên đăng nhập!',
            'ContactName.regex'=>'Tên không chứa số và ký tự đặc biệt!',
            'Email.required'=>'Vui lòng nhập email!',
            'Email.email'=>'Email không đúng định dạng!',
        ];
    }
}
