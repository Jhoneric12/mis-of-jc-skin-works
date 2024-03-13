<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_category_id',
        'price',
        'description',
        'min_qty',
        'max_qty',
        'total_qty',
        'status',
        'product_image_path',
    ];

    protected $table = 'products';

    protected $foreignKey = 'product_category_id';

    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

}
