<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            // 'code' => 'required|string|max:50|unique:coupons,code',
            // 'description' => 'nullable|string|max:255',
            // 'discount_type' => 'required|in:percentage,fixed,freeship',
            // 'discount_value' => 'required|numeric|min:0',
            // 'minimum_order_value' => 'nullable|numeric|min:0',
            // 'max_shipping_discount' => 'nullable|numeric|min:0',
            // 'max_uses' => 'required|integer|min:1',
            // 'max_uses_per_user' => 'required|integer|min:1',
            // 'start_time' => 'required|date|after_or_equal:today',
            // 'end_time' => 'required|date|after:start_time',
            // 'category_id' => 'nullable|exists:categories,id',
            // 'brand_id' => 'nullable|exists:brands,id',
            // 'is_active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            // 'code.required' => 'Mã Code không được để trống.',
            // 'code.unique' => 'Mã Code đã tồn tại.',
            // 'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            // 'discount_value.min' => 'Giá trị giảm giá phải lớn hơn hoặc bằng 0.',
            // 'start_time.after_or_equal' => 'Ngày phát hành phải từ hôm nay trở đi.',
            // 'end_time.after' => 'Ngày kết thúc phải sau ngày phát hành.',
        ];
    }
}
