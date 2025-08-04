<?php

namespace Pharmercy\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();
        if (!$user|| $user->role_id !== 3) {
            return abort(401, 'Unauthorized Access');
        }
        return response()->view('admin::dashboard');
    }
}
