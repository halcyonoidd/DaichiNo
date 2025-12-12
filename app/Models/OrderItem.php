<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'subtotal'];

    // Relasi: Item adalah spesifik 1 Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}