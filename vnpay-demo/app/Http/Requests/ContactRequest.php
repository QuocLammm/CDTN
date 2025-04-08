<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email',
            'Phone'=> 'required|numeric|digits_between:10,11',
            'Message' => 'required|string|min:10',
        ];
    }

    public function messages(): array{
        return [
            'FullName.required' => 'Vui lòng nhập họ và tên',
            'Email.required' => 'Email đã tồn tại',
            'Email.email' => 'Email không đúng định dạng',
            'Phone.required' => 'Vui lòng nhập số điện thoại',
            'Phone.numeric' => 'Số điện thoại chỉ chứa số',
            'Phone.digits_between' => 'Số điện thoại từ 10 đến 11 số',
            'Message.required' => 'Vui lòng nhập nội dung liên hệ',
            'Message.min' => 'Nội dung phải từ :min ký tự trở lên'
        ];
    }
}
