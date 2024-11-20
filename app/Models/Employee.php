<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
