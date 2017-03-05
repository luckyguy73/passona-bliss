<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingContactFormRequest extends FormRequest
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
            'message' => 'required|min:10',
        ];
    }
    
    public function messages() 
    {
        return [
            'message.required' => 'Please enter a message',
            'message.min' => 'Messages must be a minimum of 10 characters',
        ];
    }
}
