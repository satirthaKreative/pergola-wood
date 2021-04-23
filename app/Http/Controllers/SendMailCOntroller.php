<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Model\Admin\Video3D\Video3DModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\PickCanopy\PickCanopyModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\FinalProduct\FinalProductModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Front\BeforeCheckoutFinalProductModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;

class SendMailCOntroller extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('main_unique_session_key'))
        {
            $get_session_data = $request->session()->get('main_unique_session_key');
        }
        $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
        foreach($mainQuery as $mQuery)
        {
            // width query
            $getWidthQuery = MasterWidthModel::where('id',$mQuery->final_width)->get();
            foreach($getWidthQuery as $getW)
            {
                $data['master_width_length'] = $getW->master_width_length;
            }

            // height query
            $getHeightQuery = MasterHeightModel::where('id',$mQuery->final_length)->get();
            foreach($getHeightQuery as $getH)
            {
                $data['master_height_length'] = $getH->master_height_length;
            }

            // overhead shades query
            $getOverheadShadesQuery = PickOverheadShadesModel::where('id',$mQuery->final_overhead)->get();
            foreach($getOverheadShadesQuery as $getOverHead)
            {
                $data['overhead_shades'] = $getOverHead->img_standard_name;
            }

            // piller post query
            $PillerPostModelQuery = PickPostLengthModel::where('id',$mQuery->final_post_length)->get();
            foreach($PillerPostModelQuery as $getP)
            {
                $data['piller_length'] = $getP->posts_length;
            }

            $data['mount_count'] = ucwords($mQuery->final_post_mount_type);
            $data['final_canopy_type'] = ucwords($mQuery->final_canopy_type);
            $data['final_lpanel_type'] = ucwords($mQuery->final_lpanel_type);
            $data['final_price'] = ucwords($mQuery->final_price);


            
        }
            $data['new_username'] = $_GET['uname'];
            $data['new_useremail'] = $_GET['uemail'];
            $data['new_usercomment'] = $_GET['ucomment'];
        Mail::to($_GET['uemail'])->send(new SendMail($data));

        echo json_encode('success');
    }

    public function show_send_mail_form_fx(Request $request)
    {
        return view('frontend.pages.send-form');
    }
}
