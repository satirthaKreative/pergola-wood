<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomRegistrationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function createUserReg(Request $request)
    {
        $firstCheck = User::where('email', $request->input('email'))->count();
        if($firstCheck > 0)
        {
            echo json_encode('match_email');
        }
        else
        {
            $insertArr = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ];

            // insert query
            $insertQuery = User::insert($insertArr);
            if($insertQuery)
            {
                echo json_encode('success');
            }
            else
            {
                echo json_encode('error');
            }
        }
    }
}
