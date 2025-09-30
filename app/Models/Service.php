<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable=[
        "company_id",
        "service_date",
        "next_service_date", 
        "description"
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
