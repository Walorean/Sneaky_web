<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_code',
        'brand',
        'name',
        'material',
        'basic_info',
        'origin',
        'price',
    ];

    public function category(){
        return $this->belongsToMany(Category::class,
            'products_categories',
            'product_id',
            'category_id');
    }
    public function brandRelation()
    {
        return $this->belongsTo(Brand::class, 'brand', 'brand_id');
    }
    public function shoes() {
        return $this->hasMany(Shoe::class, 'product_code', 'product_code');
    }

    public function image() {
        return $this->hasMany(Image::class, 'product_code', 'product_code');
    }

}
