<?php

namespace Pharmercy\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin::welcome');
    }
}
