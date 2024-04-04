<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'medication_allergies', 'findings',  'prescription'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
