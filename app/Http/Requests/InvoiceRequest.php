<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'customer_id'=>'required|exists:users,id',
            'user_id'=>'required|exists:users,id',
            'invoice_date'=>'required|date',
            'notes'=>'nullable|string',
            'product'=>'required|exists:products,id',
            'quantity'=>'required|min:1',
            'amount'=>'required|min:0',
            
        ];
    }
}
