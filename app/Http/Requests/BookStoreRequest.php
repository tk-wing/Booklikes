<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'category' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required'],
            'comment' => ['required'],
            'img_name' => ['image'],
        ];
    }

    public function messages()
    {
        return [
            'category.required' => __('booklikes.validation.required.selected')
        ];
    }
}
