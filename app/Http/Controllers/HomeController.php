<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Home
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
           return redirect()->route('admin.login');
    }

    /**
     * Login 
     * 
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::guard()->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('admin.login');
    }

    public function thanks()
    {
        return view('frontend.thanks');
    }
}
