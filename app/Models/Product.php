<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'productname',
        'slug',
        'cateid',
        'brandid',
        'price',
        'pricediscount',
        'status',
        'description'
    ];

    /**
     * Cấu hình Quan hệ nghịch đảo với Model Category
     */
    public function category()
    {
        // products.cateid = categories.cateid
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    /**
     * Cấu hình Quan hệ nghịch đảo với Model Brand
     */
    public function brand()
    {
        // products.brandid = brands.id
        return $this->belongsTo(Brand::class, 'brandid', 'id');
    }
}