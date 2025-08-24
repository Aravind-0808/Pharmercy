<?php

namespace Pharmercy\Seller\Http\Controllers;
use Illuminate\Http\Request;


class DoctorsController
{
    public function index()
    {
        $doctors = \Pharmercy\Seller\Models\Doctors::all();
        return view('seller::doctors-table', compact('doctors'));
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
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_verified' => 'required|boolean',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('doctor_logos', 'public');
        }
        $doctor = \Pharmercy\Seller\Models\Doctors::create($data);
        return response()->json(['success' => true, 'doctor' => $doctor]);
    }

    public function update(Request $request, $id)
    {
        $doctor = \Pharmercy\Seller\Models\Doctors::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_verified' => 'required|boolean',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('doctor_logos', 'public');
        }
        $doctor->update($data);
        return response()->json(['success' => true, 'doctor' => $doctor]);
    }

    public function destroy($id)
    {
        $doctor = \Pharmercy\Seller\Models\Doctors::findOrFail($id);
        $doctor->delete();
        return response()->json(['success' => true]);
    }

}