<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    /**
     * Xác định người dùng có được phép gửi request này không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Định nghĩa các rules validation.
     */
    public function rules()
    {
        $rules = [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required|string|min:5|max:1000',
            'status'  => 'required|string|in:UNREAD,READ,REPLIED',
        ];
        if ($this->route('contact')) {
            $contact = $this->route('contact');
            if (in_array($contact->status, ['READ', 'REPLIED']) && $this->status === 'UNREAD') {
                $rules['status'] .= '|prohibited';
            }
            if ($contact->status === 'REPLIED' && $this->status === 'READ') {
                $rules['status'] .= '|prohibited';
            }
        }
        return $rules;
    }
}
