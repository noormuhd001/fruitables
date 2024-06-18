<?php

namespace App\Http\Requests\userManagement;

use Illuminate\Foundation\Http\FormRequest;

class confirmpassword extends FormRequest
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
          
            'password'=>'required|string|',
            'useremail' => 'required|string|email|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
               
            'useremail.string' => 'The category must be a string.',
            'useremail.required' => 'The email field is required.',         
            'password.required'=>'The password field is required',
            
                         
           
        ];
    }
}
