<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'CategoryName'=>'required|string|regex:/^[a-zA-Z]$/',
            'Description'=> 'required|text',
        ];
    }

    public function messages(): array{
        return [
            'CategoryName.required'=>'Vui lòng nhập tên loại sản phẩm!',
            'CategoryName.regex' => 'Tên loại sản phẩm không chứa số và kí tự đặc biệt!',
            'Description.required' => 'Vui lòng nhập mô tả loại sản phẩm!',
        ];
    }
}
