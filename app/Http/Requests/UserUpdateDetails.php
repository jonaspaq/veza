<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authenticatedUser = request()->user()->id;
        $idOfUserToEdit = $this->route()->parameter('id');

        // Checks if user is editing his own profile
        return $authenticatedUser == $idOfUserToEdit;
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
            'middle_name' => 'between:0,255',
            'last_name' => 'required|between:1,255',
        ];
    }
}
