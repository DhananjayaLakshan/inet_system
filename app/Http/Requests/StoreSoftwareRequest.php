<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoftwareRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'company_id'        => ['required', 'exists:companies,id'], // ✅ ensure company exists
            'user'              => ['required' , 'string' , 'max:255'],
            'installed_date'    => ['required', 'date'],
            'expiration_date'   =>['required', 'date', 'after:installed_date'], // ✅ better rule
            'license_key'       => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
        ];
    }
}
