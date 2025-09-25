<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $fillable =[
        'company_id',
        'name',
        'user',
        'installed_date',
        'expiration_date',
        'license_key',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
