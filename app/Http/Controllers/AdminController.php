<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Admin\FinalProduct\FinalProductModel;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.layouts.index');
    }

    public function dashboard_all_count_fx(Request $request)
    {
        $count_data = FinalProductModel::count();
        if($count_data < 10)
        {
            $count_total = "0".$count_data;
        }
        else if($count_data >= 10)
        {
            $count_total = $count_data;
        }
        echo json_encode($count_total);
    }

}
