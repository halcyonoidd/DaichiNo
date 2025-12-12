<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        return response()->json(Product::all());
    }

    // Tampilkan detail 1 produk
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json($product);
    }

    // Tambah Produk (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|in:sushi_and_sashimi,ramen_and_noodles,grilled_specialties,appetizer,dessert,drink',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product = Product::create($validated);

        return response()->json(['message' => 'Produk berhasil ditambah', 'data' => $product], 201);
    }

    // Update Produk (Admin)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
            'category' => 'in:sushi_and_sashimi,ramen_and_noodles,grilled_specialties,appetizer,dessert,drink',
            'price' => 'numeric',
            'description' => 'nullable|string',
            'is_available' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product->update($validated);

        return response()->json(['message' => 'Produk berhasil diupdate', 'data' => $product]);
    }

    // Hapus Produk (Admin)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        return response()->json(['message' => 'Produk dihapus']);
    }
}