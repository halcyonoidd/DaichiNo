<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'badge',
        'duration',
        'room',
        'price',
        'capacity',
        'menu',
        'image_path',
    ];

    public function bookings()
    {
        return $this->hasMany(ReservationBooking::class);
    }
}
