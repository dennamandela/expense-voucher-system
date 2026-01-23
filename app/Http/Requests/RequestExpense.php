<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id = $this->route('expense_voucher')?->id 
            ?? $this->route('id');
        return [
            'number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('expense_vouchers', 'number')->ignore($id),
            ],
            'date' => 'required|date',
            'paid_to' => 'required|string|max:255',
            'payment_method' => 'required|in:KAS,BANK',
            'notes' => 'nullable|string',
            'details' => 'required|array|min:1',
            'details.*.description' => 'required|string|max:255',
            'details.*.amount' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            // HEADER
            'number.required' => 'Nomor bon wajib diisi',
            'number.unique' => 'Nomor bon sudah digunakan, silakan pakai nomor lain',

            'date.required' => 'Tanggal wajib diisi',
            'date.date' => 'Format tanggal tidak valid',

            'paid_to.required' => 'Kolom dibayarkan ke wajib diisi',

            'payment_method.required' => 'Metode pembayaran wajib dipilih',
            'payment_method.in' => 'Metode pembayaran harus KAS atau BANK',

            // DETAIL
            'details.required' => 'Detail penerimaan wajib diisi',
            'details.min' => 'Minimal harus ada 1 detail penerimaan',

            'details.*.description.required' => 'Deskripsi detail wajib diisi',

            'details.*.amount.required' => 'Nominal wajib diisi',
            'details.*.amount.numeric' => 'Nominal harus berupa angka',
            'details.*.amount.min' => 'Nominal harus lebih dari 0',
        ];
    }
}
