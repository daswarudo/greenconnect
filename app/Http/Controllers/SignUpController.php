<?php

namespace App\Http\Controllers;

use App\Models\RDN;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index(){
        
        return view ('signUp');
    }
}
