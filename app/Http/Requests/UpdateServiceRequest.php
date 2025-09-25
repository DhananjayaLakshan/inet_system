<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"],
            "service_date" => ["required", "date"],
            "description" => ["required", "string"]
        ];
    }
}
