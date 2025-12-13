<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of all reservations.
     */
    public function index()
    {
        $reservations = Reservation::paginate(10);
        return view('adminPage.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        return view('adminPage.reservations.create');
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
        ]);

        Reservation::create($validated);

        return redirect()->route('admin.reservations.index')->with('status', 'Reservation berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('adminPage.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()->route('admin.reservations.index')->with('status', 'Reservation berhasil diupdate!');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('status', 'Reservation berhasil dihapus!');
    }
}
