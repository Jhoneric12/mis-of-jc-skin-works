<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'doctor_id', 'medication', 'description'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
