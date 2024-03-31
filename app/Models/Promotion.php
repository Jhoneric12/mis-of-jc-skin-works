<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['service', 'status'];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service');
    }
} 
