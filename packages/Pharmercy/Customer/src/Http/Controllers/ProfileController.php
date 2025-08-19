<?php

namespace Pharmercy\Customer\Http\Controllers;


use App\Models\User;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\Addresses;
use Pharmercy\Customer\Models\Orders;

class ProfileController
{
    public function index()
    {
        $profile = Addresses::where('user_id', auth()->id())->first();
        $user = User::where('id', auth()->id())->first();
        return view('Customer::profile', compact('profile', 'user'));
    }
}