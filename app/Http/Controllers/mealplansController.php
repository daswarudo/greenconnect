<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mealplansController extends Controller
{
    public function index(){
        return view ('mealplans');
    }
}
