<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'item_type', 'quantity', 'price'];

    public function item()
    {
        return $this->morphTo();
    }
}
