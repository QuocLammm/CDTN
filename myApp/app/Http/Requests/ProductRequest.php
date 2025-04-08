<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'ProductName' => 'required|max:255',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Description' => 'required|text|min:10',
            'Price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array{
        return [
            'ProductName.required' => 'Tên sản phẩm không được để trống',
            'Image.required' => 'Vui lòng chọn hình',
            'Image.mimes' => 'Vui lòng chọn đúng tệp hình',
            'Image.max' => 'Vui lòng chọn hình có kích thước nhỏ hơn',
            'Description.required' =>'Vui lòng nhập mô tả',
            'Description.min' => 'Mô tả ít nhất 10 từ',
            'Price.required' => 'Vui lòng nhập giá bán',
            'Price.numeric'=>'Vui lòng nhập số',
            'Price.min' => 'Vui lòng nhập số lượng lớn hơn min:',
        ];
    }
}
