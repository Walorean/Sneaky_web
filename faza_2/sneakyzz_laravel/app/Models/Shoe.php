<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['product_code', 'color_id', 'size_id', 'stock_quantity'];
    public function product() {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
    public function size() {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
    public function color() {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function images() {
        return $this->hasMany(Image::class, 'product_code', 'product_code');
    }

//    public function orderItems() {
//        return $this->hasMany(OrderItem::class, 'shoe_id', 'shoe_id');
//    }
}
