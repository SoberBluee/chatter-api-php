<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'string|nullable',
            'firstname' => 'string|nullable',
            'lastname' => 'string|nullable',
            'email'=> 'string|nullable',
            'phonenumber' => 'string|nullable',
        ];
    }
}
