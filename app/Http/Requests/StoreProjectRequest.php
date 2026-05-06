<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       
        return [
            'name' => 'required|string|min:3|max:255|not_in:test,dummy',
            'description' => 'required|string|min:5',
            'status' => 'nullable|in:active,archived,completed',
        ];
    }

    public function messages(): array
    {
       
        return [
            'name.required' => 'Project name is required.',
            'name.min' => 'Project name must contain at least 3 characters.',
            'name.not_in' => 'Project name cannot be test or dummy.',
            
            'description.min' => 'Description must contain at least 5 characters.',

            'status.required' => 'Status field is required.',
            'status.in' => 'Status must be active, archived, or completed.',
        ];
    }
}