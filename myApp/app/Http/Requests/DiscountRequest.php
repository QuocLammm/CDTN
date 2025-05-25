<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'discount_code' => ['required', 'string', 'max:255', 'unique:discounts,discount_code'],
            'description' => ['nullable', 'string'],
            'discount_amount' => ['required', 'numeric', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'discount_code.required' => 'Mã giảm giá không được để trống.',
            'discount_code.max' => 'Mã giảm giá không được dài quá :max ký tự.',
            'discount_code.unique' => 'Mã giảm giá đã tồn tại, vui lòng nhập mã khác.',
            'discount_amount.required' => 'Bạn phải nhập phần trăm giảm giá.',
            'discount_amount.numeric' => 'Phần trăm giảm giá phải là số.',
            'discount_amount.min' => 'Phần trăm giảm giá phải lớn hơn hoặc bằng 0.',
            'start_date.required' => 'Ngày bắt đầu không được để trống.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Ngày kết thúc không được để trống.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải cùng hoặc sau ngày bắt đầu.',
        ];
    }

}
