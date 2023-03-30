<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = "ideas";

    protected $primaryKey = "id";

    protected $fillable = [
        'title',
        'image',
        'description',
        'product'
    ];

    public function ideaProduct() 
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }
}
