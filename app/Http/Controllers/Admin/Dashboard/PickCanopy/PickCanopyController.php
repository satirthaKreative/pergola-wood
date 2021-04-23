<?php

namespace App\Http\Controllers\Admin\Dashboard\PickCanopy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PickCanopy\PickCanopyModel;

class PickCanopyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showPage(Request $request)
    {
        return view('backend.pages.pick-canopy.pick-canopy');
    }

    public function submitOverheadShades(Request $request)
    {
        $checkQuery = PickCanopyModel::where(['canopy_question' => strtolower($request->input('canopy_question')) ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This canopy already added before');
            return redirect()->back();
        }
        else
        {

                $insertArr = [
                    'canopy_question' => strtolower($request->input('canopy_question')), 
                    'canopy_note' => strtolower($request->input('canopy_note')), 
                    'canopy_price' => $request->input('canopy_price'), 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    
                ];
                $insertQuery = PickCanopyModel::insert($insertArr);
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
        $showQuery = PickCanopyModel::get();
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
                            <td>".ucwords($sQuery->canopy_question)."<br /><b>Note : </b>".ucwords($sQuery->canopy_note)."</td>
                            <td><b>$".$sQuery->canopy_price."</b></td>
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
        $changeQuery = PickCanopyModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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
        $changeQuery = PickCanopyModel::where('id',$_GET['id'])->delete();
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
        $changeQuery = PickCanopyModel::where('id',$_GET['id'])->get();
        foreach($changeQuery as $cData)
        {
            $html['canopy_question'] = $cData->canopy_question;
            $html['canopy_note'] = $cData->canopy_note;
            $html['canopy_price'] = $cData->canopy_price;
        }

        echo json_encode($html);
    }

    
    public function changeActionEdit(Request $request, $my_data)
    {
        $checkQuery = PickCanopyModel::where('id','!=',$my_data)->where(['canopy_question' => strtolower($request->input('canopy_question')) ])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This canopy already added before');
            return redirect()->back();
        }
        else
        {

                $insertArr = [
                    'canopy_question' => strtolower($request->input('canopy_question')), 
                    'canopy_note' => strtolower($request->input('canopy_note')), 
                    'canopy_price' => $request->input('canopy_price'), 
                    'admin_action' => 'yes', 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    
                ];
                $insertQuery = PickCanopyModel::where('id',$my_data)->update($insertArr);
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
