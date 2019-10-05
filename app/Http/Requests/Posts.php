<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Posts extends FormRequest
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
            'content' => 'required'
        ];
    }

    public function messages(){
        return [
            'content.required' => 'Your content is empty.'
        ];
    }
}
