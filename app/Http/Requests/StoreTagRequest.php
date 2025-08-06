<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'budget_heading_english' => 'required|string|max:255',
            'budget_heading_nepali' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'budget_heading_english.required' => 'English budget heading is required.',
            'budget_heading_nepali.required' => 'Nepali budget heading is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either active or inactive.',
        ];
    }
}