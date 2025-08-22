<?php

namespace Pharmercy\Seller\Http\Controllers;

use Auth;
use Log;
use Pharmercy\Customer\Models\Transaction;
use Pharmercy\Seller\Models\BankDetails;
use Pharmercy\Seller\Models\Stores;
use Illuminate\Http\Request;
use Pharmercy\Seller\Models\Wallet;
use Pharmercy\Seller\Models\WithdrawalTransaction;

class WalletController
{
    // Display a listing of wallet transactions
    public function index(Request $request)
    {
        Log::info('WalletController index method called');
        $user = Auth::user();
        $store = Stores::where('user_id', $user->id)->first();
        if (!$user || $user->role_id !== 2) {
            abort(403);
        }
        $storeId = Stores::where('user_id', $user->id)->value('id');

        $walletTransactions = Wallet::where('store_id', $storeId)->get();
        $WalletAmount = Wallet::getBalance($storeId);
        $Bank_details = BankDetails::where('store_id', $storeId)->first();

        return view('Seller::wallet-table', compact('walletTransactions', 'WalletAmount', 'Bank_details', 'storeId'));

    }

    public function withdraw(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 2) {
            abort(403);
        }

        $storeId = Stores::where('user_id', $user->id)->value('id');

        try {
            // Validate the request
            $request->validate([
                'amount' => 'required|numeric|min:100',
                'bank_details_id' => 'required|exists:store_bank_details,id' // make sure table name matches
            ]);

            // Create a withdrawal transaction
            $withdrawal = WithdrawalTransaction::create([
                'store_id' => $storeId,
                'bank_details_id' => $request->bank_details_id,
                'amount' => $request->amount,
            ]);

            // Debit wallet (linking the withdrawal ID)
            Wallet::create([
                'store_id' => $storeId,
                'amount' => $request->amount,
                'type' => 'debit',
                'description' => 'Withdrawal for order ID: ' . $withdrawal->id
            ]);

            return back()->with('success', 'Withdrawal request submitted successfully.');

        } catch (\Exception $e) {
            \Log::error('Withdrawal failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function getWithdrawalRequests()  {
        $user = Auth::user();
        if (!$user || $user->role_id !== 2) {
            return abort(403);
        }

        $storeId = Stores::where('user_id', $user->id)->value('id');
        $withdrawals = WithdrawalTransaction::where('store_id', $storeId)->get();

        return response()->view('Seller::withdrawal-request', compact('withdrawals'));
    }

}