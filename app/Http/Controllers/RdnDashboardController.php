<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RdnDashboardController extends Controller
{
    public function index(){
        return view ('rdnDashboard');
    }
}
