<?php

namespace Pharmercy\Seller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SellerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('seller::welcome');
    }
}
