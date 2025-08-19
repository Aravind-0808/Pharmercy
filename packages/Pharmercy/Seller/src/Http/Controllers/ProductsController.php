<?php

namespace Pharmercy\Seller\Http\Controllers;

use Auth;
use Pharmercy\Seller\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pharmercy\Seller\Models\Stores;


class ProductsController
{
    // Display a listing of products
    public function index(Request $request)
    {
        $user = Auth::user();
        $store = Stores::where('user_id', $user->id)->first();
        if (!$user || $user->role_id !== 2) {
            return abort(401, 'Unauthorized Access');
        }
        $storeId = $store->id;
        $products = Products::where('store_id', $storeId)->get()->map(function ($product) {
            $product->discount_price = $product->original_price - ($product->original_price * ($product->discount / 100));
            return $product;
        });
        return  view('seller::products-table', compact('products'));
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'original_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $validated['store_id'] = Stores::where('user_id', Auth::id())->value('id');
        $validated['selling_price'] = $validated['original_price'] - ($validated['original_price'] * ($validated['discount'] / 100));
        $validated['is_active'] = $request->input('is_active', 1);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product = Products::create($validated);
        return response()->json($product, 201);
    }

    // Display the specified product
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json($product);
    }

    // Update the specified product
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $validated = $request->validate([
            'store_id' => 'sometimes|exists:stores,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'original_price' => 'sometimes|numeric',
            'discount' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'is_active' => 'sometimes|boolean',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    // Remove the specified product
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
