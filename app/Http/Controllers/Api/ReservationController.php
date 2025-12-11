<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    /**
     * Store a newly created reservation in storage.
     *
     * @param  StoreReservationRequest  $request
     * @return JsonResponse
     */
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $reservation = Reservation::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'date' => $data['date'],
            'time_start' => $data['time_start'],
            'time_end' => $data['time_end'],
            'guests' => $data['guests'],
            'special_request' => $data['special_request'] ?? null,
        ]);

        return response()->json([
            'message' => 'Reservation created successfully.',
            'reservation' => $reservation,
        ], 201);
    }

    /**
     * Display a listing of reservations.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $reservations = Reservation::orderBy('date', 'desc')
            ->orderBy('time_start', 'desc')
            ->paginate(20);

        return response()->json($reservations);
    }
}
