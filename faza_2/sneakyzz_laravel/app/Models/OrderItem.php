<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'shoe_id', 'quantity'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function shoe(){
        return $this->belongsTo(Shoe::class, 'shoe_id', 'id');
    }
}
