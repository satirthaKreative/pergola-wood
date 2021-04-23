<?php

namespace App\Http\Controllers\Admin\Dashboard\ChangePassword;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class ChangePasswordController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showPage(Request $request)
    {
        return view('backend.layouts.change-pass');
    }

    public function submitPassPage(Request $request)
    {
        $new_password = $_GET['new_password'];
        $confirm_password = $_GET['confirm_password'];

        if($new_password == $confirm_password)
        {
            $changePass = Hash::make($new_password);
            $changePassQuery = Admin::where('id', 1)->update(['password' => $changePass]);
            $pass_status = 'success';
        }
        else
        {
            
            $pass_status = 'error';
        }
        echo json_encode($pass_status);
    }
}
