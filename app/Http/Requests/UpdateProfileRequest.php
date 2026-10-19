<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],

            'phone' => 'nullable|string|max:20',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'Name is required.',

            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'This email is already taken.',

            'image.image' => 'Image must be an image.',
            'image.mimes' => 'Allowed types: jpg, jpeg, png, webp.',
            'image.max' => 'Image must not exceed 2MB.',

        ];
    }
}
