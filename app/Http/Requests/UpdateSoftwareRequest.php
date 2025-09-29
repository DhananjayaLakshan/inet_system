<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoftwareRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       return [
            'company_id'        => ['required', 'exists:companies,id'],
            'user'              => ['required' , 'string' , 'max:255'],
            'installed_date'    => ['required', 'date'],
            'expiration_date'   => ['required', 'date', 'after:installed_date'],
            'license_key'       => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
        ];
    }
}
