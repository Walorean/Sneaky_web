<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id', 'user_id', 'payed_by_card', 'deliver_to_store',
        'address', 'total_price', 'user_name', 'user_surname',
        'user_phone_num', 'user_email', 'status'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
