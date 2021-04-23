<?php

namespace App\Http\Controllers\Admin\Dashboard\PickOverheadShades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterOverheadModel;

class PickOverheadShadesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function showPage(Request $request)
    {
        return view('backend.pages.pick-overhead-shades.pick-overhead-shades');
    }

    public function showActualData(Request $request)
    {
        // master height
        $fetchMasterHeight = MasterHeightModel::get();
        $html['master_height'] = '<option value="">Choose height</option>';
        if(count($fetchMasterHeight) > 0)
        {
            foreach($fetchMasterHeight as $fetchH)
            {
                $html['master_height'] .= '<option value="'.$fetchH->id.'">'.$fetchH->master_height_length.'</option>';
            }
        }

        // master width
        $fetchMasterWidth = MasterWidthModel::get();
        $html['master_width'] = '<option value="">Choose width</option>';
        if(count($fetchMasterWidth) > 0)
        {
            foreach($fetchMasterWidth as $fetchW)
            {
                $html['master_width'] .= '<option value="'.$fetchW->id.'">'.$fetchW->master_width_length.'</option>';
            }
        }

        // master overhead Shade
        $fetchMasterOverheadShades = MasterOverheadModel::get();
        $html['master_overhead'] = '<option value="">Choose overhead shades</option>';
        if(count($fetchMasterOverheadShades) > 0)
        {
            foreach($fetchMasterOverheadShades as $fetchO)
            {
                $html['master_overhead'] .= '<option value="'.$fetchO->id.'">'.$fetchO->overhead_shades_val.'</option>';
            }
        }

        echo json_encode($html);
    }

    public function showPostLoadfx(Request $request)
    {
        $w_val = $_GET['w_id'];
        $h_val = $_GET['h_id'];

        if(isset($_GET['p_id']))
        {
            $postQuery1 = PickOverheadShadesModel::where(['master_width' => $w_val, 'master_height' => $h_val, 'master_post' => $_GET['p_id']])->get();
            $html['master_overhead_shades'] = '<option value="">Choose Overhead Shades</option>';
            if(count($postQuery1) > 0)
            {
                foreach($postQuery1 as $pQuery1)
                {
                    $getPostQuery1 = MasterOverheadModel::where(['id' => $pQuery1->master_overhead_shades])->get();
                    foreach($getPostQuery1 as $gPQuery1)
                    {
                        $html['master_overhead_shades'] .= '<option value="'.$gPQuery1->id.'">'.$gPQuery1->overhead_shades_val.'</option>';
                    }
                    
                }
            }
        }

        $postQuery = PickUpFootPrintModel::where(['width_master' => $w_val, 'height_master' => $h_val])->get();
        $html['master_posts'] = '<option value="">Choose posts</option>';
        if(count($postQuery) > 0)
        {
            foreach($postQuery as $pQuery)
            {
                $getPostQuery = PillerPostModel::where(['id' => $pQuery->posts_master])->get();
                foreach($getPostQuery as $gPQuery)
                {
                    $html['master_posts'] .= '<option value="'.$gPQuery->id.'">'.$gPQuery->no_of_posts.'</option>';
                }
                
            }
        }
        echo  json_encode($html);
    }

    public function submitOverheadShades(Request $request)
    {
        $checkQuery = PickOverheadShadesModel::where(['master_width' => $request->input('master_width'), 'master_height' => $request->input('master_height'), 'master_post' => $request->input('master_post'), 'master_overhead_shades' => $request->input('ladder_spacing')])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This ladder spacing already added before');
            return redirect()->back();
        }
        else
        {
                if($request->hasFile('ladder_spacing_file'))
                {
                    $our_story_img = $request->file('ladder_spacing_file')->store('public/ladder_spacing');
                }
                else
                {
                    $our_story_img = "";
                }

                $overshadegettingQuery = MasterOverheadModel::where('id',$request->input('ladder_spacing'))->get();
                foreach($overshadegettingQuery as $oqQuery)
                {
                    $ladderSpacing = $oqQuery->overhead_shades_val;
                }
            

                $insertArr = [
                    'master_width' => $request->input('master_width'), 
                    'master_height' => $request->input('master_height'), 
                    'master_post' => $request->input('master_post'), 
                    'master_overhead_shades' => $request->input('ladder_spacing'),
                    'img_standard_name' => strtolower($ladderSpacing), 
                    'price_details' => $request->input('ladder_spacing_price'), 
                    'img_file' => $our_story_img, 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    
                ];
                $insertQuery = PickOverheadShadesModel::insert($insertArr);
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


    public function showOverheadShades(Request $request)
    {
        $showQuery = PickOverheadShadesModel::get();
        if(count($showQuery) > 0)
        {
            $html = "";
            $i = 0;
            foreach($showQuery as $sQuery)
            {
                if($sQuery->admin_action == 'yes' )
                {
                    $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sQuery->admin_action.'",'.$sQuery->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                }
                else if($sQuery->admin_action == 'no' )
                {
                    $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sQuery->admin_action.'",'.$sQuery->id.') class="btn btn-sm btn-success">Make it Active</a>';
                }
                else
                {

                }

                if($sQuery->img_file == "" || $sQuery->img_file == null)
                {
                    $img_path = "No Image";
                }
                else
                {
                    $change_path = str_replace('public','storage/app/public',$sQuery->img_file);
                    $img_path = '<img src="'.asset($change_path).'" alt="no image" width="100px" />';
                }

                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$sQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$sQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';

                // master height
                $fetchMasterHeight = MasterHeightModel::where(['id' => $sQuery->master_height])->get();
                if(count($fetchMasterHeight) > 0)
                {
                    foreach($fetchMasterHeight as $fetchH)
                    {
                        $html_master_height = $fetchH->master_height_length;
                    }
                }

                // master width
                $fetchMasterWidth = MasterWidthModel::where(['id' => $sQuery->master_width])->get();
                if(count($fetchMasterWidth) > 0)
                {
                    foreach($fetchMasterWidth as $fetchW)
                    {
                        $html_master_width = $fetchW->master_width_length;
                    }
                }

                // master overhead Shade
                $fetchMasterOverheadShades = PillerPostModel::where(['id' => $sQuery->master_post])->get();
                if(count($fetchMasterOverheadShades) > 0)
                {
                    foreach($fetchMasterOverheadShades as $fetchO)
                    {
                        $html_master_post = $fetchO->no_of_posts;
                    }
                }
                
                
                $html .= "<tr>
                            <td>".++$i."</td>
                            <td>".$img_path."</td>
                            <td>".$html_master_width."ft. <b>width</b> x ".$html_master_height."ft. <b>height</b> x ".$html_master_post." <b>post</b></td>
                            <td>".ucwords($sQuery->img_standard_name)." ( <b>$".$sQuery->price_details."</b> )</td>
                            <td>".$status."</td>
                            <td>".$action_btn." ".$del_state." ".$edit_state."</td>
                        </tr>";
            }
        }
        else
        {
            $html = '<tr>
                        <td colspan="6"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td>
                    </tr>';   
        }

        echo json_encode($html);
    }

    public function changeActionOverheadShades(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = PickOverheadShadesModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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

    // del fx

    public function delActionOverheadShades(Request $request)
    {
        $changeQuery = PickOverheadShadesModel::where('id',$_GET['id'])->delete();
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

    // view edit fx

    public function viewEditActionOverheadShades(Request $request)
    {
            $editQuery = PickOverheadShadesModel::where('id',$_GET['id'])->get();
            foreach($editQuery as $eQuery)
            {

                    $postQuery = PickUpFootPrintModel::where(['width_master' => $eQuery->master_width, 'height_master' => $eQuery->master_height])->get();
                    $html['master_posts'] = '<option value="">Choose posts</option>';
                    if(count($postQuery) > 0)
                    {
                        
                        foreach($postQuery as $pQuery)
                        {
                            $selected = "";
                            if($pQuery->posts_master == $eQuery->master_post)
                            {
                                $selected = "selected";
                            }
                            $getPostQuery = PillerPostModel::where(['id' => $pQuery->posts_master])->get();
                            foreach($getPostQuery as $gPQuery)
                            {
                                
                                $html['master_posts'] .= '<option value="'.$gPQuery->id.'" '.$selected.'>'.$gPQuery->no_of_posts.'</option>';
                            }
                            
                        }
                    }

                // master height
                $fetchMasterHeight = MasterHeightModel::get();
                $html['master_height'] = '<option value="">Choose height</option>';
                if(count($fetchMasterHeight) > 0)
                {
                    
                    foreach($fetchMasterHeight as $fetchH)
                    {
                        $selected1 = "";
                        if($fetchH->id == $eQuery->master_height)
                        {
                            $selected1 = "selected";
                        }
                        $html['master_height'] .= '<option value="'.$fetchH->id.'" '.$selected1.'>'.$fetchH->master_height_length.'</option>';
                    }
                }

                // master width
                $fetchMasterWidth = MasterWidthModel::get();
                $html['master_width'] = '<option value="">Choose width</option>';
                if(count($fetchMasterWidth) > 0)
                {
                    
                    foreach($fetchMasterWidth as $fetchW)
                    {
                        $selected2 = "";
                        if($fetchW->id == $eQuery->master_width)
                        {
                            $selected2 = "selected";
                        }
                        $html['master_width'] .= '<option value="'.$fetchW->id.'" '.$selected2.'>'.$fetchW->master_width_length.'</option>';
                    }
                }
                    // master overhead Shade
                    $fetchMasterOverheadShades = MasterOverheadModel::get();
                    $html['master_overhead'] = '<option value="">Choose overhead shades</option>';
                    if(count($fetchMasterOverheadShades) > 0)
                    {
                        
                        foreach($fetchMasterOverheadShades as $fetchO)
                        {
                            $selected3 = "";
                            if($fetchO->id == $eQuery->master_overhead_shades)
                            {
                                $selected3 = "selected";
                            }
                            $html['master_overhead'] .= '<option value="'.$fetchO->id.'" '.$selected3.'>'.$fetchO->overhead_shades_val.'</option>';
                        }
                    }
            
            $html['price_details'] = $eQuery->price_details;
            $html['img_details'] = '<img src="'.asset(str_replace('public','storage/app/public',$eQuery->img_file)).'" alt="no image" width="100px"/>';
        }
        echo json_encode($html);
    }

    // edit fx

    public function editActionOverheadShades(Request $request, $main_edit_id)
    {
        $checkQuery = PickOverheadShadesModel::where('id','!=',$main_edit_id)->where(['master_width' => $request->input('master_width'), 'master_height' => $request->input('master_height'), 'master_post' => $request->input('master_post'), 'master_overhead_shades' => $request->input('ladder_spacing')])->get();

        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This ladder spacing already added before');
            return redirect()->back();
        }
        else
        {

                $overshadegettingQuery = MasterOverheadModel::where('id',$request->input('ladder_spacing'))->get();
                foreach($overshadegettingQuery as $oqQuery)
                {
                    $ladderSpacing = $oqQuery->overhead_shades_val;
                }
                if($request->hasFile('ladder_spacing_file'))
                {
                    $our_story_img = $request->file('ladder_spacing_file')->store('public/ladder_spacing');
                    $insertArr = [
                        'master_width' => $request->input('master_width'), 
                        'master_height' => $request->input('master_height'), 
                        'master_post' => $request->input('master_post'), 
                        'master_overhead_shades' => $request->input('ladder_spacing'),
                        'img_standard_name' => strtolower($ladderSpacing), 
                        'price_details' => $request->input('ladder_spacing_price'), 
                        'img_file' => $our_story_img, 
                        'admin_action' => 'yes', 
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        
                    ];
                    $insertQuery = PickOverheadShadesModel::where('id',$main_edit_id)->update($insertArr);
                }
                else
                {
                    $insertArr = [
                        'master_width' => $request->input('master_width'), 
                        'master_height' => $request->input('master_height'), 
                        'master_post' => $request->input('master_post'), 
                        'master_overhead_shades' => $request->input('ladder_spacing'),
                        'img_standard_name' => strtolower($ladderSpacing),  
                        'price_details' => $request->input('ladder_spacing_price'), 
                        'admin_action' => 'yes', 
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        
                    ];
                    $insertQuery = PickOverheadShadesModel::where('id',$main_edit_id)->update($insertArr);
                }

                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Updated ');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Nothing is updated ! Try  again later');
                }
                return redirect()->back();
        }
    }
}
