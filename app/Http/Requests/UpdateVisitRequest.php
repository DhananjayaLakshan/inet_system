<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'company_id' => ['sometimes', 'exists:companies,id'],
            'user_id'    => ['sometimes', 'exists:users,id'],
            'visit_date' => ['sometimes', 'date'],
            'visit_time' => ['sometimes', 'date_format:H:i'],
            'leave_time' => ['sometimes', 'date_format:H:i', 'after:visit_time'],
            'work_done'  => ['sometimes', 'string', 'min:5', 'max:2000'],
        ];
    }
}
