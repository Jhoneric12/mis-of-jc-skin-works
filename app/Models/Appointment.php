<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'specialist_id',
        'patient_id',
        'date',
        'time',
        'first_name', 
        'middle_name',
        'last_name',
        'setting',
        'status'
    ];

    protected $foreignKey = [
        'service_id',
        'specialist_id',
        'patient_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function appointment()
    {
        return $this->hasMany(AppointmentSession::class);
    }
}
