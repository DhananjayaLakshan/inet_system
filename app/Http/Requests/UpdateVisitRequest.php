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
        // Accept "14:30" or "14:30:00"
        'visit_time' => ['sometimes', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
        'leave_time' => ['sometimes', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
        'work_done'  => ['sometimes', 'string', 'min:5', 'max:2000'],
    ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $visitTime = $this->input('visit_time');
            $leaveTime = $this->input('leave_time');

            if ($visitTime && $leaveTime && $visitTime >= $leaveTime) {
                $validator->errors()->add('leave_time', 'Leave time must be after visit time.');
            }
        });
    }
}
