<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::with('user')->findOrFail($request->order_id);

        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'message' => 'Snap token generated',
            'snap_token' => $snapToken,
        ]);
    }

    public function createReservationPayment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:1',
            'items.*.id' => 'nullable|string',
            'customer' => 'required|array',
            'customer.full_name' => 'required|string',
            'customer.email' => 'required|email',
            'customer.phone' => 'required|string',
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);

        $orderId = 'RESV-' . time() . '-' . rand(1000, 9999);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $validated['amount'],
            ],
            'item_details' => collect($validated['items'])->map(function ($item) {
                return [
                    'id' => $item['id'] ?? 'reservation',
                    'price' => (int) $item['price'],
                    'quantity' => (int) $item['quantity'],
                    'name' => $item['name'],
                ];
            })->toArray(),
            'customer_details' => [
                'first_name' => $validated['customer']['full_name'],
                'email' => $validated['customer']['email'],
                'phone' => $validated['customer']['phone'],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'message' => 'Snap token generated',
            'snap_token' => $snapToken,
            'order_id' => $orderId,
        ]);
    }
}
