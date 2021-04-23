<?php

namespace App\Http\Controllers\Admin\Dashboard\Visitors;

use Illuminate\Http\Request;
use App\Model\Admin\UniqueUsers;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    //
    public function showCountVisitors(Request $request)
    {
        $countVisitors = UniqueUsers::where('created_at', strtotime(date('Y-m-d 00:00:00')))->count();
        $data['countTotalVisitors'] = UniqueUsers::count();
        $data['countTodayVisitors'] = 0;
        if($countVisitors > 0)
        {
            $data['countTodayVisitors'] = $countVisitors;
        }
        echo json_encode($data);
    }
}
