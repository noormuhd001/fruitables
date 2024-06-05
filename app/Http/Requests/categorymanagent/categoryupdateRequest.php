<?php

namespace App\Http\Requests\categorymanagent;

use Illuminate\Foundation\Http\FormRequest;

class categoryupdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'photo.image' => 'The file must be an image.',
            'photo.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
