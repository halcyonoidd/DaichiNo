<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class ReservationOfferController extends Controller
{
    /**
     * Public list of reservation offerings for customers.
     */
    public function index(): JsonResponse
    {
        $offers = Reservation::select('id', 'title', 'badge', 'duration', 'room', 'price', 'capacity', 'menu', 'image_path')
            ->orderBy('price')
            ->paginate(20);

        // Transform image_path to full URL
        $offers->getCollection()->transform(function ($offer) {
            if ($offer->image_path) {
                $path = ltrim($offer->image_path, '/');
                
                // Check if path starts with common public directories
                if (str_starts_with($path, 'img/') || str_starts_with($path, 'images/') || str_starts_with($path, 'css/') || str_starts_with($path, 'js/')) {
                    // Direct public asset
                    $offer->image_url = asset($path);
                } elseif (str_starts_with($path, 'storage/')) {
                    // Already has storage prefix
                    $offer->image_url = asset($path);
                } else {
                    // Assume it's in storage
                    $offer->image_url = asset('storage/' . $path);
                }
            } else {
                $offer->image_url = null;
            }
            return $offer;
        });

        return response()->json($offers);
    }
}
