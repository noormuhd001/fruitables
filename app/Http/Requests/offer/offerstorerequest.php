<?php

namespace App\Http\Requests\offer;

use Illuminate\Foundation\Http\FormRequest;

class offerstorerequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'photo' => 'required|max:2048', // Adjust max file size as needed
            'category' => 'required|string',
            'basic_description' => 'required|string',
            'full_description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'category.string' => 'The category must be a string.',
            'category.max' => 'The category may not be greater than 20 characters.',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The image may not be greater than 2MB.',
            'basicdescription.string' => 'The basic description must be a string.',
            'fulldescription.string' => 'The full description must be a string.',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 0.',
        ];
    }
}
