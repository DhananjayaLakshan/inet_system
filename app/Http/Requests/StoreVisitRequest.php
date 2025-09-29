<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
            'visit_date' => ['required', 'date'],
            'visit_time' => ['required', 'date_format:H:i'],   // 24h format like 14:30
            'leave_time' => ['required', 'date_format:H:i', 'after:visit_time'],
            'work_done'  => ['required', 'string', 'min:5', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Please select a company.',
            'user_id.required'    => 'Please select an employee.',
            'leave_time.after'    => 'Leave time must be after visit time.',
            'work_done.min'       => 'Work description must be at least 5 characters.',
        ];
    }
}
