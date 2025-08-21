<?php

namespace Pharmercy\Seller\Http\Controllers;

use Pharmercy\Seller\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController
{
    // Display a listing of stores
  public function index()
{
    $stores = Stores::all();
    return view('Seller::store-table', compact('stores'));
}


    // Store a newly created store
   public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'address' => 'required|string|unique:stores,address',
        'country' => 'required|string',
        'state' => 'required|string',
        'city' => 'required|string',
        'zip_code' => 'required|string',
        'is_active' => 'nullable|boolean',
        'is_verified' => 'nullable|boolean',
    ]);

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets'), $filename);
        $validated['logo'] = 'assets/' . $filename;
    }

    $store = Stores::create($validated);

    return response()->json($store, 201);
}


    // Display the specified store
    public function show($id)
    {
        $store = Stores::findOrFail($id);
        return response()->json($store);
    }

    // Update the specified store
public function update(Request $request, $id)
{
    $store = Stores::findOrFail($id);

    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'address' => 'sometimes|string|unique:stores,address,' . $id,
        'country' => 'sometimes|string',
        'state' => 'sometimes|string',
        'city' => 'sometimes|string',
        'zip_code' => 'sometimes|string',
        'is_active' => 'nullable|boolean',
        'is_verified' => 'nullable|boolean',
    ]);

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets'), $filename);
        $validated['logo'] = 'assets/' . $filename;
    }

    $store->update($validated);

    return response()->json($store);
}


    // Remove the specified store
    public function destroy($id)
    {
        $store = Stores::findOrFail($id);
        $store->delete();
        return response()->json(['message' => 'Store deleted successfully']);
    }
}
