<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicInformation extends Model
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
