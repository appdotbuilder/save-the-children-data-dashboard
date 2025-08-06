<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataEntryRequest extends FormRequest
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
            'budget_headline' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'fiscal_year' => 'required|integer|min:2000|max:2100',
            'entry_date' => 'required|date',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
            'sector_ids' => 'nullable|array',
            'sector_ids.*' => 'integer|exists:sectors,id',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'municipality_id' => 'nullable|integer|exists:municipalities,id',
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
            'budget_headline.required' => 'Budget headline is required.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount must be a positive number.',
            'fiscal_year.required' => 'Fiscal year is required.',
            'entry_date.required' => 'Entry date is required.',
            'tag_ids.*.exists' => 'Selected tag is invalid.',
            'sector_ids.*.exists' => 'Selected sector is invalid.',
            'category_ids.*.exists' => 'Selected category is invalid.',
        ];
    }
}