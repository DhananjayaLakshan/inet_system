<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{

    use HasFactory;

    // 👇 Explicitly tell Laravel which table to use
    protected $table = 'softwares';
    protected $fillable =[
        'company_id',
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
