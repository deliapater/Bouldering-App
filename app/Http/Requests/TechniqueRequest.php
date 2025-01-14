<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechniqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // For Backpack admin routes
        if (request()->is('admin/*')) {
            return backpack_auth()->check();
        }
        // For other API routes
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'difficulty_level' => 'required|string|in:beginner,intermediate,advanced',
            'description' => 'nullable|string',
            'steps_to_practice' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'gear' => 'nullable|array',
            'gear.*' => 'exists:gears,id'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The technique name is required.',
            'difficulty_level.required' => 'Please select a difficulty level.',
            'image.string' => 'The uploaded file must be an image.',
            'image.max' => 'The image size must not exceed 2MB.',
            'gear.*.exists' => 'The selected gear must exist in the database.'
        ];
    }
}
