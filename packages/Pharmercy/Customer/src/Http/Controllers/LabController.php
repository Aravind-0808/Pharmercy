<?php

namespace Pharmercy\Customer\Http\Controllers;

use Pharmercy\Seller\Models\Labs;



class LabController
{
    public function index()
    {
        $labs = Labs::all();
        return view('customer::lab', compact('labs'));
    }
}