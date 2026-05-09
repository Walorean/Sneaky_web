<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'image_id';
    protected $fillable = ['filename', 'color_id', 'product_code'];

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'product_code', 'product_code')
            ->where('color_id', $this->color_id);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}
