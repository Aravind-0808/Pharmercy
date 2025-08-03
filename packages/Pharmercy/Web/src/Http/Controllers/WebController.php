<?php

namespace Pharmercy\Web\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('web::welcome');
    }
}
