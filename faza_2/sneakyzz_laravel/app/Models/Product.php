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
    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
    public function shoes() {                                        // ← premenuj z 'product' na 'shoes'
        return $this->hasMany(Shoe::class, 'product_code', 'product_code');
    }
}
