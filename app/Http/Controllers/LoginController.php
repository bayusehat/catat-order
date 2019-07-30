<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $email = $request->email;
        $password = sha1($request->password);

        $getUser = DB::table('ct_user')->where('email','=',$email)->where('password','=',$password)->where('deleted','=',0)->first();

        if($getUser === null){
            $data['data'] = FALSE;
            return response()->json($data);
        }else{
            $setUser = $getUser;
            Session::put('email',$email);
            Session::put('logged_in', TRUE);
            Session::put('id_user',$setUser->id_user);
            $data['data'] = $setUser;
            return response()->json($data);
        }
    }

    public function logout()
    {
        # code...
    }
}
