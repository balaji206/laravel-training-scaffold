<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|nullable|string',
            'status' => 'nullable|in:active,archived,completed',
        ];
    }

    public function messages(): array
    {
        
        return [
            'name.required' => 'Project name is required.',
            'name.max' => 'Project name cannot exceed 255 characters.',
            'description.min' => 'Description must be at least 5 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
        ];
    }
}