<?php

namespace App\Http\Controllers\Admin\Dashboard\PickLouveredPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;

class PickLouveredPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showPage(Request $request)
    {
        return view('backend.pages.pick-panel.pick-panel');
    }

    public function submitOverheadShades(Request $request)
    {
        $checkQuery = PickLouveredPanelModel::where(['l_panel_name' => strtolower($request->input('l_panel_name')) ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This post length already added before');
            return redirect()->back();
        }
        else
        {

                $insertArr = [
                    'l_panel_name' => strtolower($request->input('l_panel_name')), 
                    'l_panel_price' => $request->input('l_name_price'), 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $insertQuery = PickLouveredPanelModel::insert($insertArr);
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
        $showQuery = PickLouveredPanelModel::get();
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
                            <td>".ucwords($sQuery->l_panel_name)."</td>
                            <td><b>$".$sQuery->l_panel_price."</b></td>
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
        $changeQuery = PickLouveredPanelModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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

    public function changeActionDel(Request $request)
    {
        $changeQuery = PickLouveredPanelModel::where('id',$_GET['id'])->delete();
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


    public function getActionEdit(Request $request)
    {
        $changeQuery = PickLouveredPanelModel::where('id',$_GET['id'])->get();
        foreach($changeQuery as $cData)
        {
            $html['l_panel_name'] = $cData->l_panel_name;
            $html['l_panel_price'] = $cData->l_panel_price;
        }

        echo json_encode($html);
    }

    
    public function changeActionEdit(Request $request, $my_data)
    {
        $checkQuery = PickLouveredPanelModel::where('id','!=',$my_data)->where(['l_panel_name' => strtolower($request->input('l_panel_name')) ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This louvered already added before');
            return redirect()->back();
        }
        else
        {

                $insertArr = [
                    'l_panel_name' => strtolower($request->input('l_panel_name')), 
                    'l_panel_price' => $request->input('l_name_price'), 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $insertQuery = PickLouveredPanelModel::where('id',$my_data)->update($insertArr);
                if($insertQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully updated ');
                }
                else
                {
                    $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                }
                return redirect()->back();
        }
    }
}
