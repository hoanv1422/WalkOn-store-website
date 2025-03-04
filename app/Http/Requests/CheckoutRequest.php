<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'receiver_address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:COD,VNPAY,Momo,PayPal',
            'total_price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'receiver_name.required' => 'Vui lòng nhập họ và tên.',
            'receiver_email.required' => 'Vui lòng nhập email.',
            'receiver_email.email' => 'Email không hợp lệ.',
            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại không hợp lệ.',
            'receiver_address.required' => 'Vui lòng nhập địa chỉ.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'total_price.required' => 'Tổng giá không được để trống.',
            'total_price.numeric' => 'Tổng giá phải là số.',
        ];
    }
}
