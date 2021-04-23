<?php

namespace App\Http\Controllers\Admin\Dashboard\PillerPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PillerPost\PillerPostModel;

class PillerPostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // show page 
    public function showPage(Request $request)
    {
        return view('backend.pages.piller-posts.piller-post');
    }

    // submit pillers
    public function submitPiller(Request $request)
    {
        $posts_piller = $_GET['posts_count'];

        $checkingQuery = PillerPostModel::where(['no_of_posts' => $posts_piller])->get();
        if(count($checkingQuery) > 0)
        {
            $msg = "already";
        }
        else
        {
            $insertArr = [
                'no_of_posts' => $posts_piller,
                'admin_action' => 'yes',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ];
            $insertQuery = PillerPostModel::insert($insertArr);
            if($insertQuery)
            {
                $msg = "success";
            }
            else
            {
                $msg = "error";
            }
        }

        echo json_encode($msg);
    }

    // show piller post
    public function showPillerPosts(Request $request)
    {
        $showQuery = PillerPostModel::get();
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

                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$sQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$sQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';
                
                
                $html .= "<tr>
                            <td>".++$i."</td>
                            <td><b>".$sQuery->no_of_posts."</b> Posts</td>
                            <td>".$status."</td>
                            <td>".$action_btn." ".$edit_state." ".$del_state."</td>
                        </tr>";
            }
        }
        else
        {
            $html = '<tr>
                        <td colspan="4"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td>
                    </tr>';   
        }

        echo json_encode($html);
    }

    public function pillerActionChange(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = PillerPostModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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
        $changeQuery = PillerPostModel::where('id',$_GET['id'])->delete();
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
        $changeQuery = PillerPostModel::where('id',$_GET['id'])->get();
        foreach($changeQuery as $cData)
        {
            $mainData = $cData->no_of_posts;
        }

        echo json_encode($mainData);
    }

    
    public function changeActionEdit(Request $request)
    {
        $checkingQuery = PillerPostModel::where(['no_of_posts' => $_GET['posts_count']])->get();
        if(count($checkingQuery) > 0)
        {
            $msg = "already";
        }
        else
        {
            $insertArr = [
                'no_of_posts' => $_GET['posts_count'], 
                'admin_action' => 'yes', 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                
            ];
            $insertQuery = PillerPostModel::where('id',$_GET['id'])->update($insertArr);
            if($insertQuery)
            {
                $msg = "success";
            }
            else
            {
                $msg = "error";
            }
        }
        echo json_encode($msg);
    }
}
