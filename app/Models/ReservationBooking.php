<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'room',
        'date',
        'time_start',
        'time_end',
        'guests',
        'full_name',
        'email',
        'phone',
        'special_request',
        'status',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
