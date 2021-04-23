<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class CustomLoginController extends Controller
{
    //
    public function loginUser(Request $request)
    {
        $data = $request->all();

        if(Auth::attempt($data))
        {
            echo  json_encode('success');
        }
        else
        {
            echo  json_encode("error");
        }
        
    }
}
