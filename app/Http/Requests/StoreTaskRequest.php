<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       
        return [
            'title' => 'required|string|min:3|max:255|not_in:test,dummy',
            'description' => 'required|string|min:5',
            'status' => 'nullable|in:todo,in_progress,done',
        ];
    }

    public function messages(): array
    {
        
        return [
            'title.required' => 'Task title is required.',
            'title.min' => 'Task title must contain at least 3 characters.',
            'title.max' => 'Task title cannot exceed 255 characters.',
            'title.not_in' => 'Task title cannot be test or dummy.',
            
            'description.required'=>'Description is required.',
            'description.min' => 'Description must be at least 5 characters.',

            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
        ];
    }
}