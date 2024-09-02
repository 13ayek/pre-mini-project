<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class day extends Model
{
    use HasFactory;
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}


