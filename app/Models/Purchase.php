<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'category_id', 'purchase_no',  'data', 'description', 'buying_quantity', 'unit_price', 'buying_price', 'status', 'created_by', 'updated_by'];

    // protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
