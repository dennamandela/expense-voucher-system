<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestExpense extends FormRequest
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
            'number' => 'nullable|string|max:50',
            'date' => 'required|date',
            'paid_to' => 'required|string|max:255',
            'payment_method' => 'required|in:KAS,BANK',
            'notes' => 'nullable|string',

            'details' => 'required|array|min:1',
            'details.*.description' => 'required|string|max:255',
            'details.*.amount' => 'required|numeric|min:1',
        ];
    }
}
