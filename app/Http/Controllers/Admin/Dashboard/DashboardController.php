<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\User;
use App\Model\Admin\Payment;
use App\Model\Admin\Campaign;
use App\Model\Admin\CmsBanner;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('guest:admin');
    }

    public function index()
    {
        return view('backend.pages.login');
    }

    public function formSubmit(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        // attemp to login
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            // if login success, redirect to dashboard
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessfull, then redirect back
        return redirect()->back()->withInput($request->only('email','password'));
    }

    
}
