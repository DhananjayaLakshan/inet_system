<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'location',
        'employee',
        'backup_employee',
    ];

    public function software()
    {
        return $this->hasMany(Software::class);
    }

    
}
