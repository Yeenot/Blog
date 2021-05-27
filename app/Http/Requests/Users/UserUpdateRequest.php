<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed',
            'email' => 'required',
            'profile.phone_number' => 'nullable',
            'profile.mobile_number' => 'nullable',
            'profile.address' => 'nullable',
            'profile.city' => 'nullable',
            'profile.state' => 'nullable',
            'profile.zip' => 'nullable'
        ];
    }
}