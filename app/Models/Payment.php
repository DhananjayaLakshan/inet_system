<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'user_id',
        'company_id',
        'visit_id',
        'date',
        'amount',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function visit()
    {
        return $this->belongsTo(CompanyVisit::class, 'visit_id');
    }

}
