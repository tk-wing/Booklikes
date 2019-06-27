<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'password' => ['required', 'min:4', 'max:16', 'confirmed', "regex:/^(?=.*[a-z])(?=.*\d)[a-z\d]+$/"],
        ];
    }

    public function messages(){
        return [
            'password.regex' => __('booklikes.validation.alpha_num'),
        ];
    }
}

