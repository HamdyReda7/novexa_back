<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',

            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',

            'image' => 'nullable|image|max:5120',

            'link' => 'nullable|url|max:255',

            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',

            'name.required' => 'Project name is required.',
            'name.max' => 'Project name must not exceed 255 characters.',

            'description.required' => 'Project description is required.',

            'image.image' => 'The uploaded file must be an image.',
            'image.max' => 'The image size must not exceed 5MB.',

            'link.url' => 'Please enter a valid URL.',

            'status.boolean' => 'Status must be true or false.',
        ];
    }
}
