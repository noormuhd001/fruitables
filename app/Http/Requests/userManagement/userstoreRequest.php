<?php

namespace App\Http\Requests\userManagement;

use Illuminate\Foundation\Http\FormRequest;

class userstoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=>'required|string',
            'phone'=>'required|string|',
            'password'=>'required|string',
            'email' =>'required|string|email',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',            
            'email.string' => 'The category must be a string.',
            'email.required' => 'The email field is required.',
            'phone.required' => 'The phone field is required.',               
           
        ];
    }
}
