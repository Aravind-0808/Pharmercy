<?php

namespace Pharmercy\Customer\Http\Controllers;

use Pharmercy\Seller\Models\Doctors;


class DoctorsController
{

    public function index()
    {
        $doctors = Doctors::all();
        return view('Customer::doctors', compact('doctors'));
    }
}