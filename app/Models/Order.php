<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    // Relasi: Order milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order punya banyak Item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}