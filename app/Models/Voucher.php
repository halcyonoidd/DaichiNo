<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'title',
        'category',
        'description',
        'validity',
        'capacity',
        'price',
    ];
}
