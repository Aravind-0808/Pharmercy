<?php

namespace Pharmercy\Customer\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Log;
use Pharmercy\Customer\Models\Addresses;



class AddressesController
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'alt_phone' => 'nullable|string|max:20',
                'door_no' => 'required|string|max:100',
                'street' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'zip' => 'required|string|max:10',
            ]);

            $userId = Auth::id();
            $validated['user_id'] = $userId;

            Log::info('Storing address', [
                'user_id' => $userId,
                'address_data' => $validated,
            ]);

            Addresses::create($validated);

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            Log::error('Error storing address', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Optionally, you can redirect back with an error message
            return redirect()->back()->withErrors('Failed to store address. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'alt_phone' => 'nullable|string|max:20',
                'door_no' => 'required|string|max:100',
                'street' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'zip' => 'required|string|max:10',
            ]);

            $userId = Auth::id();
            $validated['user_id'] = $userId;

            Log::info('Updating address', [
                'user_id' => $userId,
                'address_data' => $validated,
            ]);

            $address = Addresses::where('id', $id)->where('user_id', $userId)->firstOrFail();
            $address->update($validated);

            return redirect()->back()->with('success', 'Address updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating address', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->withErrors('Failed to update address. Please try again.');
        }
    }


}