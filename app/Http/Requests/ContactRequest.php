<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:255',
            'middle_name' => 'nullable|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'primary_number' => 'required|digits_between:6,15',
            'secodary_number' => 'nullable|digits_between:6,15',
            'email' => 'required|email',
            'file' => 'nullable|image'
        ];
    }
}
