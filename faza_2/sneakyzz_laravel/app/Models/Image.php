<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'image_id';
    protected $fillable = ['filename', 'product_code'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}
