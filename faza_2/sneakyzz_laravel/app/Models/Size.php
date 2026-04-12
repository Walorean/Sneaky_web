<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $primaryKey = 'size_id';

    protected $fillable = ['size'];

    public function shoes() {
        return $this->hasMany(Shoe::class, 'size_id', 'size_id');
    }
}
