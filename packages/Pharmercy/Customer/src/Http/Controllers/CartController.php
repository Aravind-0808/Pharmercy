<?php

namespace Pharmercy\Customer\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Log;
use Pharmercy\Customer\Models\Addresses;
use Pharmercy\Customer\Models\Cart;
use Pharmercy\Customer\Models\Orders;



class CartController
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        return response()->view('Customer::cart', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'quantity' => $request->input('quantity', 1), // Default to 1 if not provided
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');

    }

    public function cartorder(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $addressId = Addresses::where('user_id', $userId)->value('id');
        $orders = [];

        foreach ($cartItems as $item) {
            $total_amount = $item->product->selling_price * $item->quantity;

            $validated = [
                'user_id' => $userId,
                'store_id' => $item->product->store_id,
                'product_id' => $item->product_id,
                'address_id' => $addressId,
                'quantity' => $item->quantity,
                'total_amount' => $total_amount,
                'ordered_at' => now(),
                'status' => 'pending',
            ];

            $order = Orders::create($validated);
            $orders[] = $order;
        }

        Cart::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Orders placed successfully! Please update the payment in order page.');
    }

    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $cartItem->delete();
        return redirect()->back()->with('success', 'Cart item removed successfully.');
    }


}