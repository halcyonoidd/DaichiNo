<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 1. Membuat Pesanan Baru
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = DB::transaction(function () use ($request) {
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => 0,
                    'status' => 'pending'
                ]);

                $totalPrice = 0;

                foreach ($request->items as $itemData) {
                    $product = Product::find($itemData['product_id']);

                    if (!$product->is_available) {
                        throw new \Exception("Produk {$product->name} sedang tidak tersedia.");
                    }

                    $subtotal = $product->price * $itemData['quantity'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $itemData['quantity'],
                        'price' => $product->price,
                        'subtotal' => $subtotal
                    ]);

                    $totalPrice += $subtotal;
                }

                $order->update(['total_price' => $totalPrice]);
                return $order;
            });

            return response()->json([
                'message' => 'Order berhasil dibuat',
                'data' => $order->load('items.product')
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    // 2. Melihat History Pesanan Milik Sendiri
    public function index()
    {
        $orders = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json(['data' => $orders]);
    }
    
    // 3. Melihat Detail Satu Pesanan (Milik Sendiri)
    public function show($id)
    {
        $order = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->where('id', $id)
                    ->firstOrFail();
                    
        return response()->json(['data' => $order]);
    }



    // 4. Admin: Melihat SEMUA Pesanan Masuk (Dari semua user)
    public function allOrders()
    {

        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin only.'], 403);
        }

        $orders = Order::with(['user', 'items.product']) 
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json(['data' => $orders]);
    }

    // 5. Admin: Update Status Pesanan
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin only.'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,process,send,completed,cancelled'
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status
        $order->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $order
        ]);
    }

    // 6. Admin: Hapus Pesanan
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin only.'], 403);
        }

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Hapus (Item otomatis terhapus karena on delete cascade)
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}