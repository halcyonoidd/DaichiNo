<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminVoucherController extends Controller
{
    /**
     * Display a listing of all vouchers.
     */
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return view('adminPage.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new voucher.
     */
    public function create()
    {
        return view('adminPage.vouchers.create');
    }

    /**
     * Store a newly created voucher in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'category' => 'required|in:experience_vouchers,discount_vouchers,meal_add_ons',
            'description' => 'required|string',
            'validity' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Voucher::create($validated);

        return redirect()->route('admin.vouchers.index')->with('status', 'Voucher berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified voucher.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('adminPage.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified voucher in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $voucher = Voucher::findOrFail($id);

        $validated = $request->validate([
            'badge' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'category' => 'required|in:experience_vouchers,discount_vouchers,meal_add_ons',
            'description' => 'required|string',
            'validity' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $voucher->update($validated);

        return redirect()->route('admin.vouchers.index')->with('status', 'Voucher berhasil diupdate!');
    }

    /**
     * Remove the specified voucher from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('status', 'Voucher berhasil dihapus!');
    }
}
