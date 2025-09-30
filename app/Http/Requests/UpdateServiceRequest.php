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
            "company_id" => ["required", "exists:companies,id"],
            "service_date" => ["required", "date"],
            "next_service_date" => ["required", "date", "after:service_date"],
            "description" => ["required", "string"]
        ];
    }
}
