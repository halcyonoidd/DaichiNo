<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    /**
     * Display a listing of all users (customers).
     */
    public function index()
    {
        $users = User::where('role', 'customer')->paginate(10);
        return view('adminPage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::find($id);
        
        if (!$user || $user->role === 'admin') {
            return redirect()->route('admin.users.index')->withErrors('User tidak ditemukan atau tidak bisa dihapus.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('status', 'User berhasil dihapus.');
    }
}
