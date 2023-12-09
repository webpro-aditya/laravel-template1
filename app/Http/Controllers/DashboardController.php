<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function __construct()
    {
        if (!Auth::user()) {
            return redirect()->route('admin.login');
        }
    }

    public function index()
    {
        return view('admin.dashboard');
    }

}
