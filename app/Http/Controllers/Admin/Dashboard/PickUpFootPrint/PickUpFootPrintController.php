<?php

namespace App\Http\Controllers\Admin\Dashboard\PickUpFootPrint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;


class PickUpFootPrintController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // show page 
    public function showPage(Request $request)
    {
        return view('backend.pages.pickup-footprint.pick-up-footprint');
    }

    // all show  --- width
    public function masterWidthShow(Request $request)
    {
        $widthQuery = MasterWidthModel::where('admin_action','yes')->get();
        $html = '<option value="">Choose A Master Width</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $html .= '<option value="'.$wQuery->id.'">'.$wQuery->master_width_length.' ft.</option>';
            }
        }
        echo json_encode($html);
    }

    // all show  --- height
    public function masterHeightShow(Request $request)
    {
        $widthQuery = MasterHeightModel::where('admin_action','yes')->get();
        $html = '<option value="">Choose A Master Height</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $html .= '<option value="'.$wQuery->id.'">'.$wQuery->master_height_length.' ft.</option>';
            }
        }
        echo json_encode($html);
    }

    // show all posts no.

    public function showAllPosts(Request $request)
    {
        $checkQuery = PillerPostModel::where(['admin_action' => 'yes' ])->get();
        if(count($checkQuery) > 0)
        {
            $html = '<option value="">Choose no. of posts</option>';
            foreach($checkQuery as $cQuery)
            {
                $html .= '<option value="'.$cQuery->id.'"><b>'.$cQuery->no_of_posts.'</b> posts</option>';
            }
        }
        else
        {
            $html = '<option value="">Choose no. of posts</option>';
        }
        echo json_encode($html);
    }

    // insert all data
    public function insertPickAFootprint(Request $request){
        $checkQuery = PickUpFootPrintModel::where(['height_master' => $request->input('height_in_feet_master'), 'width_master' => $request->input('width_in_feet_master'), 'posts_master' => $request->input('posts_in_feet_master') ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else
        {
                if($request->hasFile('img_in_feet_master'))
                {
                    $our_story_img = $request->file('img_in_feet_master')->store('public/pick-up-footage/master');
                }
                else
                {
                    $our_story_img = "";
                }

            

                $insertArr = [
                    'height_master' => $request->input('height_in_feet_master'), 
                    'width_master' => $request->input('width_in_feet_master'), 
                    'posts_master' => $request->input('posts_in_feet_master'), 
                    'price_master' => $request->input('price_in_feet_master'), 
                    'img_master' => $our_story_img, 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    
                ];
                $insertQuery = PickUpFootPrintModel::insert($insertArr);
                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Inserted Our Story');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                }
                return redirect()->back();
        }
    }

    // show view table page

    public function showViewPage(Request $request)
    {
        return view('backend.pages.pickup-footprint.view-pick-up-footprint');
    }

    // all data shown in view table page

    public function allDataOnShowViewPage(Request $request)
    {
        $mainQuery = PickUpFootPrintModel::get();

        if(count($mainQuery) > 0)
        {
            $html = "";
            $i = 0;
            foreach($mainQuery as $mQuery)
            {
                if($mQuery->img_master == "" || $mQuery->img_master == null)
                {
                    $img_path = "No Image";
                }
                else
                {
                    $change_path = str_replace('public','storage/app/public',$mQuery->img_master);
                    $img_path = '<img src="'.asset($change_path).'" alt="no image" width="100px" />';
                }
                // get width number
                $getWidthQuery = MasterWidthModel::where('id',$mQuery->width_master)->get();
                foreach($getWidthQuery as $widthQuery)
                {
                    $getWidthDT = $widthQuery->master_width_length;
                }

                // get height number
                $getHeightQuery = MasterHeightModel::where('id',$mQuery->height_master)->get();
                foreach($getHeightQuery as $heightQuery)
                {
                    $getHeightDT = $heightQuery->master_height_length;
                }

                // get no. of posts
                $getPostsQuery = PillerPostModel::where('id',$mQuery->posts_master)->get();
                foreach($getPostsQuery as $gQuery)
                {
                    $getPosts = $gQuery->no_of_posts;
                }
                // end of get no. of posts

                $html .= '<tr>
                            <td>'.++$i.'</td>
                            <td>'.$img_path.'</td>
                            <td>'.$getWidthDT.' ft. </td>
                            <td>'.$getHeightDT.' ft.</td>
                            <td>'.$getPosts.' posts</td>
                            <td><b>$ </b>'.$mQuery->price_master.'</td>
                            <td><a href="javascript: ;" class="text-danger" onclick=del_pick_up_footprint('.$mQuery->id.')><i class="fa fa-trash"></i></a>  <a href="javascript:;" onclick=pick_up_footprint_edit_model_fx('.$mQuery->id.') class="text-info" )><i class="fa fa-edit"></i></a></td>;
                        </tr>';
            }
        }
        else
        {
            $html = '<tr><td colspan="7"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td></tr>';
        }

        echo  json_encode($html);
    }

    // delete 

    public function delParticularData(Request $request)
    {
        $delQuery = PickUpFootPrintModel::where('id',$_GET['id'])->delete();
        if($delQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }

        echo json_encode($msg);
    }

    // 

    public function getAllFootprintData(Request $request)
    {
        $mainQuery = PickUpFootPrintModel::where('id',$_GET['id'])->get();
        foreach($mainQuery as $mQuery)
        {
            // height
            $html['foot_width'] = '<option value="">Choose A Width</option>';
            $getWidth = MasterWidthModel::get();
            foreach($getWidth as $getW)
            {
                $selectW = "";
                if($getW->id == $mQuery->width_master)
                {
                    $selectW = "selected";
                }
                $html['foot_width'] .= '<option value="'.$getW->id.'" '.$selectW.'>'.$getW->master_width_length.' ft.</option>';
            }

            // width
            $html['foot_height'] = '<option value="">Choose A Height</option>';
            $getHeight = MasterHeightModel::get();
            foreach($getHeight as $getH)
            {
                $selectH = "";
                if($getH->id == $mQuery->height_master)
                {
                    $selectH = "selected";
                }
                $html['foot_height'] .= '<option value="'.$getH->id.'" '.$selectH.'>'.$getH->master_height_length.' ft.</option>';
            }

            $html['foot_posts'] = '<option value="">Choose A Posts No.</option>';
            $getPosts = PillerPostModel::get();
            foreach($getPosts as $getP)
            {
                $selectP = "";
                if($getP->id == $mQuery->posts_master)
                {
                    $selectP = "selected";
                }
                $html['foot_posts'] .= '<option value="'.$getP->id.'" '.$selectP.'>'.$getP->no_of_posts.' Posts.</option>';
            }

            // for price
            $html['foot_price'] = $mQuery->price_master;

            // for img
            $html['foot_img'] = '<img src="'.asset(str_replace('public','storage/app/public',$mQuery->img_master)).'" alt="no image" width="100px" />';

        }
        echo json_encode($html);
    }

    public function editModalPartFx(Request $request)
    {
        $checkQuery = PickUpFootPrintModel::where('id','!=',$request->input('footprint_main_id'))->where(['height_master' => $request->input('height_in_feet_selct_id'), 'width_master' => $request->input('width_in_feet_selct_id'), 'posts_master' => $request->input('posts_in_feet_selct_id') ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else
        {
                if($request->hasFile('img_in_feet_master'))
                {
                    $our_story_img = $request->file('img_in_feet_master')->store('public/pick-up-footage/master');
                    $insertArr = [
                        'height_master' => $request->input('height_in_feet_selct_id'), 
                        'width_master' => $request->input('width_in_feet_selct_id'), 
                        'posts_master' => $request->input('posts_in_feet_selct_id'), 
                        'price_master' => $request->input('price_of_feet'), 
                        'img_master' => $our_story_img, 
                        'admin_action' => 'yes', 
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $insertQuery = PickUpFootPrintModel::where('id',$request->input('footprint_main_id'))->update($insertArr);
                }
                else
                {
                    $insertArr = [
                        'height_master' => $request->input('height_in_feet_selct_id'), 
                        'width_master' => $request->input('width_in_feet_selct_id'), 
                        'posts_master' => $request->input('posts_in_feet_selct_id'), 
                        'price_master' => $request->input('price_of_feet'), 
                        'admin_action' => 'yes', 
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $insertQuery = PickUpFootPrintModel::where('id',$request->input('footprint_main_id'))->update($insertArr);
                }

            

                
                
                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Updated');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Nothing is updated');
                }
                return redirect()->back();
        }
    }
}
