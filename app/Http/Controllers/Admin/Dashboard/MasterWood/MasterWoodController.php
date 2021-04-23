<?php

namespace App\Http\Controllers\Admin\Dashboard\MasterWood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterWoodController extends Controller
{
    // master wood types 
    
    public function index(Request $request)
    {
        return view('backend.pages.master-wood.master-wood');
    }
}
