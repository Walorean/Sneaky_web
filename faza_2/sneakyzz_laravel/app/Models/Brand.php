<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';

    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
