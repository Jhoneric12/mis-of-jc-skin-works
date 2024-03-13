<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_category_id',
        'price',
        'description',
        'status',
        'nno_of_sessions',
    ];

    protected $table = 'services';

    protected $foreignKey = 'service_category_id';

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
