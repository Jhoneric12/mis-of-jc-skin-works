<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'status'];

    protected $primaryKey = 'category_id';

    protected $table = 'product_categories';

    
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
