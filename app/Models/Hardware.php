<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    protected $table= "hardwares";

    protected $fillable = 
    [
        'company_id',
        'user',
        'date',
        'warranty',
        'brand',
        'description'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
