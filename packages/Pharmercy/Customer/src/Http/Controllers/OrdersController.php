<?php

namespace Pharmercy\Customer\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Customer\Models\UserWallet;
use Pharmercy\Seller\Models\Wallet;

class OrdersController
{


    public function index()
    {
        $orders = Orders::where('user_id', auth()->id())->get();
        return view('Customer::orders', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address_id' => 'required|exists:addresses,id',
            'total_amount' => 'required|numeric',
            'ordered_at' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $validated['ordered_at'] = $validated['ordered_at'] ?? now();

        $order = Orders::create($validated);

        // Redirect to Razorpay payment page
        if ($request->input('type') === 'wallet') {
            $orderAmount = $order->total_amount;
            $SellerAmount =  $orderAmount - ($orderAmount * 0.3); 

            UserWallet::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'amount' => $orderAmount,
                'type' => 'debit',
            ]);

            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => $SellerAmount,
                'type' => 'credit',
            ]);
            Orders::where('id', $order->id)->update(['status' => 'paid']);

            return redirect()->back()->with('success', 'Order placed successfully using wallet.');
        }
        else{
            return redirect()->route('payment.initiate', ['order_id' => $order->id]);
        }
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['status' => 'canceled']);

        $orderAmount = $order->total_amount;
        $SellerAmount =  $orderAmount - ($orderAmount * 0.3); // Assuming 30% is the platform fee

            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => $SellerAmount,
                'type' => 'debit',
            ]);

            UserWallet::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'amount' => $orderAmount,
                'type' => 'credit',
            ]);

        return redirect()->back()->with('success', 'Order has been canceled successfully.');
    }

}