<?php

namespace Pharmercy\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Customer\Models\Transaction;
use Pharmercy\Seller\Models\Wallet;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentController
{
    public function initiate($order_id)
    {
        $order = Orders::findOrFail($order_id);

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => (string) $order->id,
            'amount' => intval($order->total_amount * 100),
            'currency' => 'INR',
        ]);

        $transaction = Transaction::create([
            'razorpay_order_id' => $razorpayOrder['id'],
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'currency' => 'INR',
            'status' => 'pending',
        ]);

        return view('Customer::payment', [
            'order' => $order,
            'razorpayOrder' => $razorpayOrder,
            'transaction' => $transaction,
            'razorpayKey' => env('RAZORPAY_KEY_ID'),
        ]);
    }

    public function success(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
        ]);

        $transaction = Transaction::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();
        $order = $transaction->order;

        $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            $transaction->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'status' => 'success',
                'payload' => json_encode($request->all()),
            ]);

            $order->update(['status' => 'paid']);
            $walletAmount = round($order->total_amount * 0.7, 2);

            Wallet::create([
                'store_id' => $order->store_id, // the wallet owner
                'transaction_id' => $transaction->id,
                'amount' => $walletAmount,
                'type' => 'credit',
                'description' => 'Payment received for order ID: ' . $order->id
            ]);

            // Return the success view directly
            return view('Customer::success', compact('order'));

        } catch (\Throwable $e) {
            \Log::error('Razorpay signature verification failed', ['error' => $e->getMessage()]);

            $transaction->update([
                'status' => 'failed',
                'payload' => json_encode($request->all()),
            ]);

            // Return the failed view directly
            return view('Customer::failed', [
                'order_id' => $order->id,
                'store_id' => $order->store_id,
                'product_id' => $order->product_id,
            ]);
        }
    }


    public function failed(Request $request)
    {
        if ($request->filled('razorpay_order_id')) {
            $transaction = Transaction::where('razorpay_order_id', $request->razorpay_order_id)->first();
            if ($transaction) {
                $transaction->update([
                    'status' => 'failed',
                    'payload' => json_encode($request->all()),
                ]);

                $order_id = $transaction->order_id;
                $order = $transaction->order;

                return view('Customer::failed', [
                    'order_id' => $order_id,
                    'store_id' => $order->store_id,
                    'product_id' => $order->product_id,
                ]);
            }
        }

        // fallback if order not found
        return view('Customer::failed', [
            'order_id' => null,
            'store_id' => null,
            'product_id' => null,
        ]);
    }

}
