<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'staff_id', 'patient_name', 'payment_mode', 'total_amount'];

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
