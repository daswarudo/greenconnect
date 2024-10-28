<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\RDN;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view ('login');
    }

    public function auth(Request $request){
        $request->validate([
            "username"=>"required",
            "password"=>"required",
        ]);
        $credentials = $request->only("username", "password");
        $user = DB::table('rdn')->where('username', $credentials['username'])->first();

        if ($user && password_verify($credentials['password'], $user->password)) {
            return redirect()->intended(route("rdnDashboard"));
        }

        
    }

}
