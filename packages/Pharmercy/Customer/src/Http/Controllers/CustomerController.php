<?php

namespace Pharmercy\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('customer::welcome');
    }
}
