<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'user_id'    => ['required', 'exists:users,id'],
            'date'       => ['required', 'date'],
            'description'=> ['nullable', 'string'],
            'amount'     => ['required', 'numeric', 'min:0'],
        ];
    }
}
