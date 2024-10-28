<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RdnDashboardController extends Controller
{
    public function index(){
        return view ('rdnDashboard');
    }

    public function dashboard(){
        $user = Auth::user();
        return view('rdnDashboard',compact('user'));
    }
}
