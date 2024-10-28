<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewsubscriberController extends Controller
{
    public function index(){
        return view ('viewsubscriber');
    }
}
