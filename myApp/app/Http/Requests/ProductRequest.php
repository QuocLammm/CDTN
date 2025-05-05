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
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'category_id' => 'required|exists:categories,category_id',
            'product_name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Vui lòng chọn nhà cung cấp!',
            'category_id.required' => 'Vui lòng chọn loại sản phẩm!',
            'product_name.required' => 'Tên sản phẩm không được để trống!',
            'image.mimes' => 'Vui lòng chọn đúng tệp hình!',
            'image.max' => 'Vui lòng chọn hình có kích thước nhỏ hơn!',
            'description.required' => 'Vui lòng nhập mô tả!',
            'description.min' => 'Mô tả ít nhất 10 từ!',
            'price.required' => 'Vui lòng nhập giá bán!',
            'price.numeric' => 'Vui lòng nhập số!',
            'price.min' => 'Vui lòng nhập số lượng lớn hơn 0!',
        ];
    }

}
