<?php

namespace Pharmercy\Seller\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Seller\Models\Stores;
use Pharmercy\Seller\Models\Products;
use Pharmercy\Customer\Models\Addresses;

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
}
