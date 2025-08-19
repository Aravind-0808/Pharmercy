<?php

namespace Pharmercy\Seller\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Log;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Seller\Models\BankDetails;
use Pharmercy\Seller\Models\Products;
use Pharmercy\Seller\Models\Stores;
use Pharmercy\Seller\Models\Wallet;



class SellerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();
        if (!$user || $user->role_id !== 2) {
            return abort(401, 'Unauthorized Access');
        }
        $store_id = Stores::where('user_id', $user->id)->value('id');
        $Total_orders = Orders::where('store_id', $store_id)->count();
        $Total_products = Products::where('store_id', $store_id)->count();
        $Wallet_balance = Wallet::getBalance($store_id);
        $Bank_details = BankDetails::where('store_id', $store_id)->first();

        return response()->view('seller::dashboard', compact('Total_orders', 'Total_products', 'Wallet_balance'));
    }

    public function generate($orderId)
    {
        $order = Orders::with([
            'user',
            'product.store',
            'address'
        ])->findOrFail($orderId);

        $pdf = Pdf::loadView('Seller::invoices', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('invoice_' . $order->id . '.pdf');
    }

}
