<?php

namespace Pharmercy\Seller\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Seller\Models\Stores;
use Pharmercy\Seller\Models\Wallet;


class OrderController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $store = Stores::where('user_id', $user->id)->first();
        if (!$user || $user->role_id !== 2) {
            abort(403);
        }
        $storeId = Stores::where('user_id', $user->id)->value('id');
        $orders = Orders::where('store_id', $storeId)
            ->with(['product', 'address'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('Seller::order-table', compact('orders'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if ($order->payment_type == 3 && $request->status === 'delivered') {
            Log::info('Processing order with COD', ['order_id' => $order->id]);
            Wallet::create([
                'store_id' => $order->store_id,
                'amount' => $order->total_amount - ($order->total_amount * 0.7),
                'type' => 'debit',
                'description' => 'Payment deducted for order ID: ' . $order->id
            ]);

        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
