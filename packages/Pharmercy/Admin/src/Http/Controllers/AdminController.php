<?php

namespace Pharmercy\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pharmercy\Customer\Models\Orders;
use Pharmercy\Customer\Models\Transaction;
use Pharmercy\Seller\Models\BankDetails;
use Pharmercy\Seller\Models\Products;
use Pharmercy\Seller\Models\Stores;
use Pharmercy\Seller\Models\Wallet;
use Pharmercy\Seller\Models\WithdrawalTransaction;

class AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        $Total_orders = Orders::count();
        $Total_stores = Stores::count();
        $Total_products = Products::count();
        $Total_commissions = Transaction::where('status', 'success')->sum('amount');
        return response()->view('admin::dashboard', compact('Total_orders', 'Total_stores', 'Total_commissions', 'Total_products'));
    }
    public function storeTable(): Response
    {
        $user = Auth::user();
        $userData = User::where('role_id', 2)->get();
        $stores = Stores::all();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        return response()->view('admin::store-table', compact('stores', 'userData'));
    }

    public function productTable(): Response
    {
        $user = Auth::user();
        $products = Products::all();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        return response()->view('admin::products-table', compact('products'));
    }

    public function transactionTable(): Response
    {
        $user = Auth::user();
        $transactions = Transaction::all();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        return response()->view('admin::transaction-table', compact('transactions'));
    }

    public function orderTable(): Response
    {
        $user = Auth::user();
        $orders = Orders::with(['user', 'product', 'store', 'address'])->get();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        return response()->view('admin::order-table', compact('orders'));
    }

    public function walletTable(): Response
    {
        $user = Auth::user();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        // Assuming you have a Wallet model to fetch wallet transactions
        $walletTransactions = Wallet::with('store', 'transaction')->get();
        return response()->view('admin::wallet-table', compact('walletTransactions'));
    }

    public function storeWalletAmount(): Response
    {
        $user = Auth::user();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }

        // Get each store with its total wallet amount
        $storeWallets = Wallet::select('store_id')
            ->selectRaw("
        SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) as total_credit,
        SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as total_debit,
        SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) - 
        SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as total_balance
    ")
            ->with('store')
            ->groupBy('store_id')
            ->get();


        return response()->view('admin::store-wallet-amount', compact('storeWallets'));
    }

    public function withdrawalRequest(): Response
    {
        $user = Auth::user();
        if (!$user || $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        $withdrawals = WithdrawalTransaction::all();
        return response()->view('admin::withdrawal-request', compact('withdrawals'));
    }

    // AdminWithdrawalController.php
    public function updateStatus(Request $request, $id)
    {
        $withdrawal = WithdrawalTransaction::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $withdrawal->status = $request->status;
        $withdrawal->save();

        return response()->json(['success' => true]);
    }

    public function showBankDetails()
    {
        $bankDetails = BankDetails::all();
        return response()->view('admin::bank-details', compact('bankDetails'));
    }

}
