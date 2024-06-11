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
            'title' => 'required|string|max:255',
            'photo' => 'required|max:2048', // Adjust max file size as needed
            'description' => 'required|string',
            'percentage' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'percentage.required' => 'The percentage field is required.',
            'percentage.integer' => 'The percentage must be a integer.',
            'price.required' => 'The price field is required.',
            'price.integer' => 'The price must be a integer.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The image may not be greater than 2MB.',
            'description.string' => 'The basic description must be a string.',
            'description.required' => 'The  description  field is required.',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 0.',
        ];
    }
}
