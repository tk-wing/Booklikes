<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],

            // 'password' => ['regex:/^(?=.*[a-z])(?=.*\d)[a-z\d]+$/',
            'password' => ['required', 'min:4', 'max:16', 'confirmed', "regex:/^(?=.*[a-z])(?=.*\d)[a-z\d]+$/"],
            'img_name' => ['image'],
        ];
    }

    public function messages(){
        return [
            'password.regex' => __('booklikes.validation.alpha_num'),
        ];
    }
}
