<?php

namespace App\Http\Controllers\Admin\Dashboard\Video3D;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Video3D\Video3DModel;
use App\Model\Admin\PickCanopy\PickCanopyModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\FinalProduct\FinalProductModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;
use App\Model\Admin\MasterOverheadModel;


class Video3DController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showPage(Request $request)
    {
        return view('backend.pages.video-3d.video-3d');
    }

    public function editViewChangeActionFx(Request $request)
    {
        // no of pillers
        $no_of_pillerQuery = PillerPostModel::where('admin_action','yes')->get();
        $html['no_of_piller_options'] = "<option value=''>Choose no of posts</option>";
        if(count($no_of_pillerQuery) > 0)
        {
            
            foreach($no_of_pillerQuery as $nQuery){
                $newQ = Video3DModel::where('id',$_GET['id'])->get();
                $selected = "";
                foreach($newQ as $nQ)
                {
                    $p_id = $nQ->master_posts;
                    if($nQuery->id == $p_id)
                    {
                        $selected = "selected";
                    }
                    $html['no_of_piller_options'] .= '<option value="'.$nQuery->id.'" '.$selected.'>'.$nQuery->no_of_posts.' posts</option>';
                    $html['master_3D_video'] = $nQ->master_3D_video;
                }
                
            }
        }

        // master width's
        $masterWidthQuery = MasterWidthModel::where('admin_action','yes')->get();
        $html['master_width_query'] = "<option value=''>Choose master width</option>";
        if(count($masterWidthQuery) > 0)
        {    
            foreach($masterWidthQuery as $mQuery)
            {
                $newQ = Video3DModel::where('id',$_GET['id'])->get();
                $selected = "";
                foreach($newQ as $nQ)
                {
                    $p_id = $nQ->master_width;
                    if($mQuery->id == $p_id)
                    {
                        $selected = "selected";
                    }
                    $html['master_width_query'] .= '<option value="'.$mQuery->id.'" '.$selected.'>'.$mQuery->master_width_length.' Ft.</option>';
                }
            }
        }

        // master height's
        $masterHeightQuery = MasterHeightModel::where('admin_action','yes')->get();
        $html['master_height_query'] = "<option value=''>Choose master height</option>";
        if(count($masterHeightQuery) > 0)
        {    
            foreach($masterHeightQuery as $mHQuery)
            {
                $newQ = Video3DModel::where('id',$_GET['id'])->get();
                $selected = "";
                foreach($newQ as $nQ)
                {
                    $p_id = $nQ->master_height;
                    if($mHQuery->id == $p_id)
                    {
                        $selected = "selected";
                    }
                    
                    $html['master_height_query'] .= '<option value="'.$mHQuery->id.'" '.$selected.'>'.$mHQuery->master_height_length.' Ft.</option>';
            
                }
            }
        }

        // overhead shades
        $masterOverheadShadesQuery = MasterOverheadModel::where('admin_action','yes')->get();
        $html['master_overhead_query'] = "<option value=''>Choose Overhead Shades</option>";
        if(count($masterOverheadShadesQuery) > 0)
        {    
            foreach($masterOverheadShadesQuery as $mOVQuery)
            {
                $newQ = Video3DModel::where('id',$_GET['id'])->get();
                $selected = "";
                foreach($newQ as $nQ)
                {
                    $p_id = $nQ->master_overhead;
                    if($mOVQuery->id == $p_id)
                    {
                        $selected = "selected";
                    }
                    
                    $html['master_overhead_query'] .= '<option value="'.$mOVQuery->id.'" '.$selected.'>'.$mOVQuery->overhead_shades_val.'</option>';
                }
                
            }
        }

        echo json_encode($html);
    }

    public function getDataPageFx(Request $request)
    {
        // no of pillers
        $no_of_pillerQuery = PillerPostModel::where('admin_action','yes')->get();
        $html['no_of_piller_options'] = "<option value=''>Choose no of posts</option>";
        if(count($no_of_pillerQuery) > 0)
        {
            foreach($no_of_pillerQuery as $nQuery){
                $html['no_of_piller_options'] .= '<option value="'.$nQuery->id.'">'.$nQuery->no_of_posts.' posts</option>';
            }
        }

        // master width's
        $masterWidthQuery = MasterWidthModel::where('admin_action','yes')->get();
        $html['master_width_query'] = "<option value=''>Choose master width</option>";
        if(count($masterWidthQuery) > 0)
        {    
            foreach($masterWidthQuery as $mQuery)
            {
                $html['master_width_query'] .= '<option value="'.$mQuery->id.'">'.$mQuery->master_width_length.' Ft.</option>';
            }
        }

        // master height's
        $masterHeightQuery = MasterHeightModel::where('admin_action','yes')->get();
        $html['master_height_query'] = "<option value=''>Choose master height</option>";
        if(count($masterHeightQuery) > 0)
        {    
            foreach($masterHeightQuery as $mHQuery)
            {
                $html['master_height_query'] .= '<option value="'.$mHQuery->id.'">'.$mHQuery->master_height_length.' Ft.</option>';
            }
        }

        // overhead shades
        $masterOverheadShadesQuery = MasterOverheadModel::where('admin_action','yes')->get();
        $html['master_overhead_query'] = "<option value=''>Choose Overhead Shades</option>";
        if(count($masterOverheadShadesQuery) > 0)
        {    
            foreach($masterOverheadShadesQuery as $mOVQuery)
            {
                $html['master_overhead_query'] .= '<option value="'.$mOVQuery->id.'">'.$mOVQuery->overhead_shades_val.'</option>';
            }
        }

        echo json_encode($html);
    }


    public function getTableDataPageFx(Request $request)
    {
        $mainQuery = Video3DModel::get();
        
       
        if(count($mainQuery) > 0)
        {
            $html['show_3d_show'] = "";
            $i = 0;
            foreach($mainQuery as $mQuery)
            {
                if($mQuery->master_3D_video != "" || $mQuery->master_3D_video != null)
                {
                    $video_data = "<iframe id='3dviewerplayer' type='text/html' width='150' height='100' src=".$mQuery->master_3D_video." frameborder='0' scrolling='no' allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>";
                }

                // width 
                $widthQuery = MasterWidthModel::where(['admin_action' => 'yes', 'id' => $mQuery->master_width ])->get();
                foreach($widthQuery as $wQuery)
                {
                    $width_master = $wQuery->master_width_length;
                }

                // height 
                $heightQuery = MasterHeightModel::where(['admin_action' => 'yes', 'id' => $mQuery->master_height ])->get();
                foreach($heightQuery as $hQuery)
                {
                    $height_master = $hQuery->master_height_length;
                }

                // no of posts 
                $pillerQuery = PillerPostModel::where(['admin_action' => 'yes', 'id' => $mQuery->master_posts ])->get();
                foreach($pillerQuery as $pQuery)
                {
                    $no_of_posts_master = $pQuery->no_of_posts;
                }

                // overhead shades 
                $overheadShadesQuery = MasterOverheadModel::where(['admin_action' => 'yes', 'id' => $mQuery->master_overhead ])->get();
                foreach($overheadShadesQuery as $ohQuery)
                {
                    $overhead_master = $ohQuery->overhead_shades_val;
                }

                // active inactive status
                if($mQuery->admin_action == 'yes' )
                {
                    $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$mQuery->admin_action.'",'.$mQuery->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                }
                else if($mQuery->admin_action == 'no' )
                {
                    $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$mQuery->admin_action.'",'.$mQuery->id.') class="btn btn-sm btn-success">Make it Active</a>';
                }
                else
                {

                }

                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$mQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$mQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';

                $html['show_3d_show'] .= '<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$video_data.'</td>
                                            <td>'.$width_master.' ft.</td>
                                            <td>'.$height_master.' ft.</td>
                                            <td>'.$no_of_posts_master.' posts</td>
                                            <td>'.$overhead_master.'</td>
                                            <th>'.$status.'</th>
                                            <th>'.$action_btn.' '.$edit_state.' '.$del_state.'</th>
                                        </tr>';
            }
        }
        else
        {
            $html['show_3d_show'] = '<tr><td colspan="8"><center class="text-danger"><i class="fa fa-trash"></i> No data yet</center></td></tr>';
        }

        echo json_encode($html);
    }

    

    public function getChangeActionFx(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = Video3DModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
        if($changeQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }

        echo json_encode($msg);
    }

    // delete fx
    public function delActionFx(Request $request)
    {
        $changeQuery = Video3DModel::where('id',$_GET['id'])->delete();
        if($changeQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }

        echo json_encode($msg);
    }

    public function submit_video3D_fx(Request $request)
    {
        $checkQuery = Video3DModel::where(['master_width' => $request->input('master_width') , 'master_height' => $request->input('master_length'), 'master_posts' => $request->input('no_of_posts') , 'master_overhead' => $request->input('overhead_shades') ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'Video 3D data already added before');
            return redirect()->back();
        }
        else
        {
                

                $insertArr = [
                    'master_width' => $request->input('master_width'), 
                    'master_height' => $request->input('master_length'), 
                    'master_posts' => $request->input('no_of_posts'),
                    'master_overhead' => $request->input('overhead_shades'),
                    'master_3D_video' => $request->input('final_product_img'),
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $insertQuery = Video3DModel::insert($insertArr);
                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Inserted ');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                }
                return redirect()->back();
        }
    }


    public function editActionFx(Request $request, $my_data)
    {
        $checkQuery = Video3DModel::where('id','!=',$my_data)->where(['master_width' => $request->input('master_width') , 'master_height' => $request->input('master_length'), 'master_posts' => $request->input('no_of_posts') , 'master_overhead' => $request->input('overhead_shades') ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This 3D panel already added before');
            return redirect()->back();
        }
        else
        {
               
                    $insertArr = [
                        'master_width' => $request->input('master_width'), 
                        'master_height' => $request->input('master_length'), 
                        'master_posts' => $request->input('no_of_posts'),
                        'master_overhead' => $request->input('overhead_shades'),
                        'master_3D_video' => $request->input('final_product_img'),
                        'admin_action' => 'yes', 
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $insertQuery = Video3DModel::where('id',$my_data)->update($insertArr);
                

                
                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Updated ');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                }
                return redirect()->back();
        }
    }
}
