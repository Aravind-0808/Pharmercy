<?php

namespace Pharmercy\Seller\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pharmercy\Seller\Models\BankDetails;
use Pharmercy\Seller\Models\Stores;

class StoreBankDetailsController
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'bank_name'           => 'required|string|max:255',
                'account_holder_name' => 'required|string|max:255',
                'account_number'      => 'required|string|max:20',
                'ifsc_code'           => 'required|string|max:11',
                'branch_name'         => 'nullable|string|max:255',
                'upi_id'              => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Get logged-in user's store_id
            $storeId = Stores::where('user_id', Auth::id())->value('id');

            if (!$storeId) {
                return back()->with('error', 'No store found for this user.');
            }

            // Attach store_id
            $data = $validator->validated();
            $data['store_id'] = $storeId;

            // Save Bank Details
            BankDetails::create($data);

            return back()->with('success', 'Bank details added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'bank_name'           => 'required|string|max:255',
                'account_holder_name' => 'required|string|max:255',
                'account_number'      => 'required|string|max:20',
                'ifsc_code'           => 'required|string|max:11',
                'branch_name'         => 'nullable|string|max:255',
                'upi_id'              => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Update Bank Details
            BankDetails::where('id', $id)->update($validator->validated());

            return back()->with('success', 'Bank details updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
}
