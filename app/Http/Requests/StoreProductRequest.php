<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'price_income' => 'required|numeric|min:0|max:9999999999.99', // Giá không vượt quá giới hạn
            'price' => 'required|numeric|min:0|max:9999999999.99',
            'price_sale' => 'nullable|numeric|min:0|max:9999999999.99|lt:price', // Giá sale phải nhỏ hơn giá gốc
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ chấp nhận ảnh, tối đa 2MB
            'product_galleries.*' => 'nullable|image|mimes:jpeg,png,jpg', // Mỗi ảnh trong thư viện ảnh
            'product_variant' => 'nullable|array|min:1', // Bắt buộc, phải là mảng, ít nhất 1 biến thể
            'product_variant.*.size' => 'required', // Dung lượng biến thể
            'product_variant.*.color' => 'required', // Màu sắc biến thể
            'product_variant.*.quantity' => 'required|numeric|min:0', // Số lượng biến thể, không âm
            'product_variant.*.price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'description.string' => 'Mô tả sản phẩm phải là dạng văn bản.',

            'price_income.required' => 'Giá nhập không được để trống.',
            'price_income.numeric' => 'Giá nhập phải là số.',
            'price_income.min' => 'Giá nhập phải lớn hơn hoặc bằng 0.',
            'price_income.max' => 'Giá nhập quá lớn, vui lòng nhập giá trị hợp lệ.',

            'price.required' => 'Giá bán không được để trống.',
            'price.numeric' => 'Giá bán phải là số.',
            'price.min' => 'Giá bán phải lớn hơn hoặc bằng 0.',
            'price.max' => 'Giá bán quá lớn, vui lòng nhập giá trị hợp lệ.',

            'price_sale.numeric' => 'Giá khuyến mãi phải là số.',
            'price_sale.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'price_sale.max' => 'Giá khuyến mãi quá lớn, vui lòng nhập giá trị hợp lệ.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá bán.',

            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Ảnh không được lớn hơn 2MB.',

            'product_galleries.*.image' => 'Mỗi tệp trong thư viện ảnh phải là hình ảnh.',
            'product_galleries.*.mimes' => 'Ảnh trong thư viện phải có định dạng: jpeg, png, jpg.',

            'product_variant.array' => 'Danh sách biến thể sản phẩm không hợp lệ.',
            'product_variant.min' => 'Sản phẩm phải có ít nhất một biến thể.',

            'product_variant.*.size.required' => 'Dung lượng của biến thể không được để trống.',

            'product_variant.*.color.required' => 'Màu sắc của biến thể không được để trống.',

            'product_variant.*.quantity.required' => 'Số lượng của biến thể không được để trống.',
            'product_variant.*.quantity.numeric' => 'Số lượng của biến thể phải là số.',
            'product_variant.*.quantity.min' => 'Số lượng của biến thể không được âm.',

            'product_variant.*.price.required' => 'Giá của biến thể không được để trống.',
            'product_variant.*.price.numeric' => 'Giá của biến thể phải là số.',
            'product_variant.*.price.min' => 'Giá của biến thể phải lớn hơn hoặc bằng 0.',
        ];
    }

}
