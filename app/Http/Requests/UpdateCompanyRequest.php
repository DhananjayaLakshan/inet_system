<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'phone_number'    => ['required', 'string', 'max:20'],
            'location'        => ['required', 'string', 'max:255'],
            'employee'        => ['required', 'string', 'max:255'],
            'backup_employee' => ['nullable', 'string', 'max:255'],
        ];
    }
}
