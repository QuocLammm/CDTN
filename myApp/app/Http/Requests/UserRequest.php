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
            'RoleID' =>'required|integer|in:1,3',
            'FullName'=>'required|string|regex:/^[a-zA-Z]{3,20}$/',
            'Address'=>'required|string|max:255',
            'Phone' => [
                'required',
                'numeric',
                'digits_between:10,11'
            ],
            'Password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'AccountName' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'Date_of_Birth' => 'required|date|date_format:Y-m-d',
            'Image'=>'required|images|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Gender'=>'required|in:Male,Female',
            'Email'=> 'required|email|unique',
        ];
    }

    public function messages(): array{
        return [
            'RoleID.required' => 'Vui lòng chọn quyền hạng!',
            'RoleID.in' => 'Quyền hạng bạn chọn không phù hợp!',
            'FullName.required' =>'Vui lòng nhập họ và tên!',
            'FullName.regex' => 'Tên chỉ chứa chữ thường và chữ hoa có dấu, tên tối thiểu 3 đến 20 ký tự!',
            'Address.required' => 'Vui lòng nhập địa chỉ!',
            'Phone.required' => 'Vui lòng nhập số điện thoại!',
            'Phone.numeric' => 'Số điện thoại chỉ là số!',
            'Phone.digits_between' =>'Số điện thoại phải từ 10 đến 12 số!',
            'Password.required' => 'Vui lòng nhập mật khẩu',
            'Password.min' => 'Mật khẩu tối thiểu min: ký tự',
            'Password.regex' => 'Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.',
            'AccountName.required' => 'Vui lòng nhập tên đăng nhập!',
            'AccountName.regex'=>'Tên đăng nhập chỉ chứa chữ, số và kí tự đặc biệt (không chứa khoảng trắng)',
            'Date_of_Birth.required' => 'Vui lòng nhập ngày sinh.',
            'Date_of_Birth.date' => 'Ngày sinh không hợp lệ.',
            'Date_of_Birth.date_format' => 'Ngày sinh phải có định dạng yyyy-mm-dd (VD: 2000-01-01).',
            'Image.required'=>'Vui lòng chọn ảnh',
            'Image.mimes' => 'Vui lòng chọn loại tệp phù hợp!',
            'Gender.required'=>'Vui lòng chọn giới tính!',
            'Gender.in' => 'Vui lòng chọn Nam hoặc Nữ',
            'Email.required'=>'Vui lòng nhập email!',
            'Email.email'=>'Email không đúng định dạng!',
            'Email.unique' => 'Email đã tồn tại!'
        ];
    }
}
