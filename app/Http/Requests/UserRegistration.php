<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends FormRequest
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
            'first_name' => 'required|between:1,255',
            'middle_name' => 'sometimes|between:0,255',
            'last_name' => 'required|between:1,255',
            'email' => 'required|unique:users,email|between:1,191',
            'password' => 'required|between:6,32',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
