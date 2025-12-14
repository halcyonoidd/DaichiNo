<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationBooking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    /**
     * Store a newly created reservation booking in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'room' => 'required|string|max:100',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'guests' => 'required|integer|min:1',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'special_request' => 'nullable|string',
        ]);

        // Check overlap for the same room/date
        $conflict = ReservationBooking::where('room', $data['room'])
            ->where('date', $data['date'])
            ->whereIn('status', ['booked', 'pending'])
            ->where(function ($q) use ($data) {
                $q->where('time_start', '<', $data['time_end'])
                    ->where('time_end', '>', $data['time_start']);
            })
            ->exists();

        if ($conflict) {
            return response()->json([
                'message' => 'Slot sudah terisi untuk ruangan dan waktu tersebut.',
                'available' => false,
            ], 409);
        }

        $booking = ReservationBooking::create([
            'reservation_id' => $data['reservation_id'],
            'room' => $data['room'],
            'date' => $data['date'],
            'time_start' => $data['time_start'],
            'time_end' => $data['time_end'],
            'guests' => $data['guests'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'special_request' => $data['special_request'] ?? null,
            'status' => 'booked',
        ]);

        return response()->json([
            'message' => 'Reservasi berhasil disimpan.',
            'booking' => $booking,
            'available' => true,
        ], 201);
    }

    /**
     * Display a listing of the reservation bookings.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $bookings = ReservationBooking::with('reservation')
            ->orderBy('date', 'desc')
            ->orderBy('time_start', 'desc')
            ->paginate(20);

        return response()->json($bookings);
    }

    /**
     * Check availability for a room/time slot.
     */
    public function checkAvailability(Request $request): JsonResponse
    {
        $data = $request->validate([
            'room' => 'required|string|max:100',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ]);

        $conflict = ReservationBooking::where('room', $data['room'])
            ->where('date', $data['date'])
            ->whereIn('status', ['booked', 'pending'])
            ->where(function ($q) use ($data) {
                $q->where('time_start', '<', $data['time_end'])
                    ->where('time_end', '>', $data['time_start']);
            })
            ->exists();

        return response()->json([
            'available' => !$conflict,
        ]);
    }
}
