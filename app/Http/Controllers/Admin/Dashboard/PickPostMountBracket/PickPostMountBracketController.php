<?php

namespace App\Http\Controllers\Admin\Dashboard\PickPostMountBracket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;


class PickPostMountBracketController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth:admin');
        }

        public function showPage(Request $request)
        {
            return view('backend.pages.pick-post-slap.pick-post-slap');
        }
    
        public function submitOverheadShades(Request $request)
        {
            $checkQuery = PickPostMountBracketModel::where(['pick_slap_name' => strtolower($request->input('post_length')) ])->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This post length already added before');
                return redirect()->back();
            }
            else
            {
    
                    $insertArr = [
                        'pick_slap_name' => strtolower($request->input('post_length')), 
                        'price_details' => $request->input('post_length_price'), 
                        'admin_action' => 'yes', 
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        
                    ];
                    $insertQuery = PickPostMountBracketModel::insert($insertArr);
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
            $showQuery = PickPostMountBracketModel::get();
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


                    $del_state = '<a href="javascript: ;" onclick=make_del_change('.$sQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                    $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$sQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';
    
                    
                    
                    
                    $html .= "<tr>
                                <td>".++$i."</td>
                                <td>".ucwords($sQuery->pick_slap_name)."</td>
                                <td><b>$".$sQuery->price_details."</b></td>
                                <td>".$status."</td>
                                <td>".$action_btn." ".$del_state." ".$edit_state."</td>
                            </tr>";
                }
            }
            else
            {
                $html = '<tr>
                            <td colspan="5"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td>
                        </tr>';   
            }
    
            echo json_encode($html);
        }
    
        public function overheadShadesActionChange(Request $request)
        {
            if($_GET['state'] == "yes")
            {
                $state = "no";
            }
            else if($_GET['state'] == "no")
            {
                $state = "yes";
            }
            $changeQuery = PickPostMountBracketModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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
        public function delActionChange(Request $request)
        {
            $changeQuery = PickPostMountBracketModel::where('id',$_GET['id'])->delete();
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
        public function viewEditActionChange(Request $request)
        {
            $editQuery = PickPostMountBracketModel::where('id',$_GET['id'])->get();
            foreach($editQuery as $eQuery)
            {
                $html['name_type'] = $eQuery->pick_slap_name;
                $html['price_details'] = $eQuery->price_details;
            }
            echo json_encode($html);
        }

        // edit fx
        public function editActionChange(Request $request, $edit_id)
        {
            $checkQuery = PickPostMountBracketModel::where('id','!=',$edit_id)->where(['pick_slap_name' => strtolower($request->input('post_length')) ])->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This slap name already added before');
                return redirect()->back();
            }
            else
            {
    
                    $insertArr = [
                        'pick_slap_name' => strtolower($request->input('post_length')), 
                        'price_details' => $request->input('post_length_price'), 
                        'admin_action' => 'yes', 
                        'updated_at' => date('Y-m-d H:i:s')
                        
                    ];
                    $insertQuery = PickPostMountBracketModel::where('id',$edit_id)->update($insertArr);
                    if($insertQuery)
                    {
                        $request->session()->flash('success_msg', 'Successfully Update ');
                    }
                    else
                    {
                        $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                    }
                    return redirect()->back();
            }
        }
}
