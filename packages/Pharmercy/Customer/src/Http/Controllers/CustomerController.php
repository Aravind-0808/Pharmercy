<?php

namespace Pharmercy\Customer\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Pharmercy\Customer\Models\UserWallet;
use Pharmercy\Seller\Models\Stores;
use Pharmercy\Seller\Models\Products;
use Pharmercy\Customer\Models\Addresses;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $query = Stores::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('zip_code') && $request->zip_code !== 'Select Zip Code') {
            $query->where('zip_code', $request->zip_code);
        }
        if ($request->filled('country') && $request->country !== 'Select Country') {
            $query->where('country', $request->country);
        }
        if ($request->filled('state') && $request->state !== 'Select State') {
            $query->where('state', $request->state);
        }
        if ($request->filled('city') && $request->city !== 'Select City') {
            $query->where('city', $request->city);
        }

        $stores = $query->get();
        $allStores = Stores::all();
        $zipCodes = $allStores->pluck('zip_code')->unique();
        $countries = $allStores->pluck('country')->unique();
        $states = $allStores->pluck('state')->unique();
        $cities = $allStores->pluck('city')->unique();
        Log::info('Customer index viewed', ['stores' => $stores]);
        return response()->view('Customer::index', compact('stores', 'zipCodes', 'countries', 'states', 'cities'));
    }

    public function product(Request $request): Response
    {
        $query = Products::query();
        $storeId = $request->route('store_id');

        if ($storeId) {
            $query->where('store_id', $storeId);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        Log::info('Customer product viewed', ['products' => $products, 'store_id' => $storeId]);
        return response()->view('Customer::product-list', compact('products', 'storeId'));
    }

    public function viewProduct($id): Response
    {
        $product = Products::findOrFail($id);
        $product->discount_price = $product->original_price - ($product->original_price * ($product->discount / 100));
        Log::info('Customer viewed product', ['product_id' => $id, 'product' => $product]);
        return response()->view('Customer::product-view', compact('product'));
    }

    public function checkout(Request $request, $store_id, $product_id, $quantity)
    {
        $product = Products::findOrFail($product_id);
        $address = Addresses::where('user_id', auth()->id())->first();
        $WalletAmount = UserWallet::getWalletBalance(auth()->id());
        return response()->view('Customer::checkout', compact('product', 'address', 'quantity', 'WalletAmount'));
    }
}
