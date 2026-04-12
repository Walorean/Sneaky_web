<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $primaryKey = 'color_id';

    protected $fillable = ['name','value'];

    public function shoes() {
        return $this->hasMany(Shoe::class, 'color_id', 'color_id');
    }
}
