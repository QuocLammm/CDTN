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
            'supplier_id'   => 'nullable|string|max:50', // Nếu nhập thủ công, có thể check unique nếu cần
            'supplier_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'phone'         => 'required|numeric|digits_between:10,11',
            'contact_name'  => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'address'       => 'required|string|max:255',
            'email'         => 'required|email',
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_name.required'    => 'Vui lòng nhập tên nhà cung cấp!',
            'supplier_name.regex'       => 'Tên không được chứa số hoặc ký tự đặc biệt!',
            'phone.required'            => 'Vui lòng nhập số điện thoại!',
            'phone.numeric'             => 'Số điện thoại phải là số!',
            'phone.digits_between'      => 'Số điện thoại phải từ 10 đến 11 chữ số!',
            'contact_name.required'     => 'Vui lòng nhập tên người liên hệ!',
            'contact_name.regex'        => 'Tên người liên hệ không được chứa số hoặc ký tự đặc biệt!',
            'address.required'          => 'Vui lòng nhập địa chỉ!',
            'email.required'            => 'Vui lòng nhập email!',
            'email.email'               => 'Email không đúng định dạng!',
            'created_at.date'           => 'Ngày tạo không đúng định dạng!',
            'updated_at.date'           => 'Ngày cập nhật không đúng định dạng!',
        ];
    }
}
