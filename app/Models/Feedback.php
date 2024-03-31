<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'rating', 'message'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
