<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVisit extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'visit_date',
        'visit_time',
        'leave_time',
        'work_done',
    ];

    protected $table = 'company_visits'; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
