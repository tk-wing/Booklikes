<?php

namespace App\Http\Requests;

use App\Models\Bookshelf;
use App\Rules\BookAddRule;
use Illuminate\Foundation\Http\FormRequest;

class BookAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $bookshelf = Bookshelf::find($this->bookshelf);
        return auth()->user()->id === $bookshelf->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bookshelf' => [new BookAddRule($this->book)],
        ];
    }
}
