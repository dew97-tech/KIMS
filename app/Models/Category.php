<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['category_name', 'parent_category_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * getParentCategoryIdAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function getParentCategoryIdAttribute($value)
    {
        return $value ?? 'No Parent Category';
    }
    /**
     * parentCategory
     *
     * @return void
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}
