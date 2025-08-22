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
        Log::info('Order placement initiated', ['request' => $request->all()]);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address_id' => 'required|exists:addresses,id',
            'total_amount' => 'required|numeric',
            'payment_type' => 'required|integer|in:1,2,3',
            'ordered_at' => 'nullable|date',
            'status' => 'nullable|string|max:255',
        ]);

        $validated['ordered_at'] = $validated['ordered_at'] ?? now();
        $validated['status'] = $validated['status'] ?? 'pending';

        $order = Orders::create($validated);

        //  Razorpay payment
        if ($validated['payment_type'] == 1) {
            Log::info('Processing order with Razorpay payment', ['order_id' => $order->id]);
            return redirect()->route('payment.initiate', ['order_id' => $order->id]);
        }


        //  Wallet payment
        if ($validated['payment_type'] == 2) {
            Log::info('Processing order with wallet payment', ['order_id' => $order->id]);

            $orderAmount = $order->total_amount;
            $sellerAmount = $orderAmount - ($orderAmount * 0.3);

            UserWallet::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'amount' => $orderAmount,
                'type' => 'debit',
            ]);

            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => $sellerAmount,
                'type' => 'credit',
                'description' => 'payment received by orderid: ' . $order->id
            ]);

            $order->update(['status' => 'paid']);

            return redirect()->back()->with('success', 'Order placed successfully using wallet.');
        }

        //  COD (Cash on Delivery)
        if ($validated['payment_type'] == 3) {
            Log::info('Processing order with COD', ['order_id' => $order->id]);

            $order->update(['status' => 'processing']);

            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => 0,
                'type' => 'credit',
                'description' => 'payment received by orderid: ' . $order->id
            ]);

            return redirect()->back()->with('success', 'Order placed successfully. Pay on delivery.');
        }

        // Fallback
        return redirect()->back()->with('error', 'Invalid payment type.');
    }


    public function cancelcodOrder(Request $request, $id)
    {
        Log::info('Cancelling COD order', ['order_id' => $id]);
        $order = Orders::findOrFail($id);
        if ($order->payment_type == 3) {
            $order->update(['status' => 'cancelled']);
            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => 0,
                'type' => 'debit',
                'description' => 'payment deducted for orderid: ' . $order->id
            ]);
            return redirect()->back()->with('success', 'Order has been cancelled successfully.');
        }
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        $orderAmount = $order->total_amount;
        $SellerAmount = $orderAmount - ($orderAmount * 0.3); // Assuming 30% is the platform fee

        Wallet::create([
            'store_id' => $order->store_id,
            'amount' => $SellerAmount,
            'type' => 'debit',
            'description' => 'payment deducted for orderid: ' . $order->id
        ]);

        UserWallet::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'amount' => $orderAmount,
            'type' => 'credit',
        ]);

        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
    }

}