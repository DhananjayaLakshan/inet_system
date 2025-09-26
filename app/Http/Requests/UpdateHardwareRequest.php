<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHardwareRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
         return [
            'company_id'=> ['required', 'exists:companies,id'],
            'user'=> ['required','string'],
            'date' => ['required', 'date'],
            'warranty' => ['required', 'string'],
            'brand'=> ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}
