<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
     */

    public function rules(): array
    {
        return [
            'name_ar' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'name_ar')->ignore($this->route('category') ?? $this->route('id')),
            ],

            'name_en' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'name_en')->ignore($this->route('category') ?? $this->route('id')),
            ],

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'This category already exists.',
            'name.max' => 'Category name must not exceed 255 characters.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, webp.',
            'image.max' => 'The image size must not exceed 2MB.',

            'status.boolean' => 'Status must be true or false.',
        ];
    }
}
