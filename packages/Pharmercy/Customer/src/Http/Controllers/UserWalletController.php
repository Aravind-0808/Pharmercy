<?php

namespace Pharmercy\Customer\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\UserWallet;

class UserWalletController
{
   public  function index(Request $request): Response
    {
        $userId = $request->user()->id;
        $walletBalance = UserWallet::getWalletBalance($userId);
        $walletTransactions = UserWallet::where('user_id', $userId)->get();

        Log::info('User wallet balance viewed', ['user_id' => $userId, 'balance' => $walletBalance]);

        return response()->view('Customer::userWallet', compact('walletBalance', 'walletTransactions'));
    }
}