<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check(); // Checks if the user is authenticated
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'receiver_name' => 'required|string|min:4|max:40',
            'receiver_email' =>  [
                'required',
                'email',
                'min:5', // Email phải có ít nhất 5 ký tự
                'max:255', // Email tối đa 255 ký tự
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Kiểm tra email hợp lệ
            ],
            'receiver_phone' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'receiver_address' => 'required|string|max:500',
            'note' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'receiver_name.required' => 'Vui lòng nhập họ và tên.',
            'receiver_name.min' => 'Họ tên phải từ 4 ký tự trở lên.',
            'receiver_name.max' => 'Họ tên phải nhỏ hơn 40 ký tự.',
            'receiver_name.string' => 'Họ tên phải là chuỗi ký tự.',
            'receiver_email.required' => 'Vui lòng nhập email.',
            'receiver_email.email' => 'Email không hợp lệ.',
            'receiver_email.min' => 'Email phải có ít nhất :min ký tự.',
            'receiver_email.max' => 'Email không được vượt quá :max ký tự.',
            'receiver_email.regex' => 'Email không đúng định dạng.',
            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại không hợp lệ.',
            'receiver_address.required' => 'Vui lòng nhập địa chỉ.',
            'note.string' => 'Ghi chú là chuỗi ký tự.',
            'note.max' => 'Ghi chú quá dài.',

        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Unauthorized',
        ], 403));
    }
}