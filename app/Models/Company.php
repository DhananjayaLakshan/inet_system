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
        'link',
        'employee',
        'backup_employee',
    ];

    public function softwares()
    {
        return $this->hasMany(Software::class);
    }

    public function hardwares()
    {
        return $this->hasMany(Hardware::class);
    }

    public function visits()
    {
        return $this->hasMany(CompanyVisit::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    
}
