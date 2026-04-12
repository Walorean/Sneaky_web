<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'image_id';
    protected $fillable = ['filename', 'shoe_id'];

    public function shoe() {
        return $this->belongsTo(Shoe::class, 'shoe_id', 'id');
    }
}
