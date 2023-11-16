<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['product_id','order_no', 'order_date', 'customer_name', 'total_amount', 'quantity', 'unit_price', 'status', 'created_by', 'updated_by'];

    // protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
