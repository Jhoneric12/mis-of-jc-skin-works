<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'status'];

    protected $primaryKey = 'category_id';

    protected $table = 'service_categories';

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
