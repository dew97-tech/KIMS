<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['product_name', 'product_description', 'category_id', 'brand_id', 'unit_id', 'product_price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
