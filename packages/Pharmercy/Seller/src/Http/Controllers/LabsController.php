<?php

namespace Pharmercy\Seller\Http\Controllers;
use Illuminate\Http\Request;

class LabsController
{
	public function index()
	{
		$labs = \Pharmercy\Seller\Models\Labs::all();
		return view('seller::labs-table', compact('labs'));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'logo' => 'nullable|image',
			'address' => 'required|string',
			'country' => 'required|string',
			'state' => 'required|string',
			'city' => 'required|string',
			'zip_code' => 'required|string',
			'lab_type' => 'required|string',
			'phone' => 'nullable|string',
			'whatsapp' => 'nullable|string',
			'is_active' => 'required|boolean',
			'is_verified' => 'required|boolean',
		]);
		if ($request->hasFile('logo')) {
			$data['logo'] = $request->file('logo')->store('lab_logos', 'public');
		}
		$lab = \Pharmercy\Seller\Models\Labs::create($data);
		return response()->json(['success' => true, 'lab' => $lab]);
	}

	public function update(Request $request, $id)
	{
		$lab = \Pharmercy\Seller\Models\Labs::findOrFail($id);
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'logo' => 'nullable|image',
			'address' => 'required|string',
			'country' => 'required|string',
			'state' => 'required|string',
			'city' => 'required|string',
			'zip_code' => 'required|string',
			'lab_type' => 'required|string',
			'phone' => 'nullable|string',
			'whatsapp' => 'nullable|string',
			'is_active' => 'required|boolean',
			'is_verified' => 'required|boolean',
		]);
		if ($request->hasFile('logo')) {
			$data['logo'] = $request->file('logo')->store('lab_logos', 'public');
		}
		$lab->update($data);
		return response()->json(['success' => true, 'lab' => $lab]);
	}

	public function destroy($id)
	{
		$lab = \Pharmercy\Seller\Models\Labs::findOrFail($id);
		$lab->delete();
		return response()->json(['success' => true]);
	}
}
