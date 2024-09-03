<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email' , 'phone_number', 'position', 'hire_date'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
