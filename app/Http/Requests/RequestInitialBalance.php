<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestInitialBalance extends FormRequest
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
            'year' => ['required','integer','min:2000','max:' . now()->year],
            'month' => ['required','integer','between:1,12'],
            'amount' => ['required','numeric','min:1'],
            // validasi unik kombinasi:
            Rule::unique('opening_balances')->where(fn($q) =>
                $q->where('year', $this->year)->where('month', $this->month)
            ),
        ];
    }

    public function messages(): array
    {
        return [
            'year.required' => 'Year is required.',
            'month.between' => 'Month must be between 1 and 12.',
            'amount.min' => 'Amount must be greater than zero.',
        ];
    }
}
