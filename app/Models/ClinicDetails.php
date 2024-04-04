<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_description',
        'weekly_sched',
        'time_sched',
        'email',
        'contact_number',
        'facebook',
        'twitter',
        'home_address',
    ];
}
