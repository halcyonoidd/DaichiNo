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
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'duration' => 'required|string|max:100',
            'room' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'menu' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reservations', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

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
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'duration' => 'required|string|max:100',
            'room' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'menu' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reservations', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

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
