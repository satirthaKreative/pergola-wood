<?php

namespace App\Http\Controllers\Admin\Dashboard\CombinationPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\CombinationModel\CombinationModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterOverheadModel;

class CombinationController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('backend.pages.combination-product.combination-product');
    }

    public function showActualData(Request $request)
    {
        $mainQuery = PickPostLengthModel::get();
        if(count($mainQuery) > 0)
        {
            $html['combination_data'] = "<option value=''>choose combination</option>";
            foreach($mainQuery as $mQuery)
            {
                $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                foreach($heightQuery as $hQuery)
                {
                    $mainHeight = $hQuery->master_height_length;
                }

                $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                foreach($widthQuery as $wQuery)
                {
                    $mainWidth = $wQuery->master_width_length;
                }

                $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                foreach($postQuery as $pQuery)
                {
                    $mainPost = $pQuery->no_of_posts;
                }

                $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                foreach($overHeadQuery as $ohQuery)
                {
                    $mainOverhead = $ohQuery->overhead_shades_val;
                }

                $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                foreach($postLengthQuery as $phQuery)
                {
                    $mainPostLength = $phQuery->master_post_length;
                }
                $html['combination_data'] .= "<option value='".$mQuery->id."'>".$mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades</option>";
            }

           
        }
        echo  json_encode($html);
    }

    public function addActualData(Request $request)
    {
        $combination_panel_val = $request->input('combination_name');

        $exist_price = $request->input('exist_price');
        $new_price = $request->input('new_price');

        $canopy_price = $request->input('canopy_price');
        $canopy_description = $request->input('canopy_description');

        $left_price = $request->input('left_price');
        $rear_price = $request->input('rear_price');
        $right_price = $request->input('right_price');
        $left_rear_price = $request->input('left_rear_price');
        $right_rear_price = $request->input('right_rear_price');
        $left_right_rear_price = $request->input('left_right_rear_price');

        $mainQuery = CombinationModel::where('combination_id',$combination_panel_val)->get();
        if(count($mainQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else 
        {
            $insertArr = [
                'combination_id' => $combination_panel_val, 
                'existing_price' => $exist_price, 
                'new_price' => $new_price, 
                'canopy_list' => $canopy_description, 
                'canopy_price' => $canopy_price, 
                'left_price' => $left_price, 
                'right_price' => $rear_price, 
                'rear_price' => $right_price, 
                'left_rear_price' => $left_rear_price, 
                'right_rear_price' => $right_rear_price, 
                'left_right_rear_price' => $left_right_rear_price, 
                'created_at' => date('y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insertQuery = CombinationModel::insert($insertArr);
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

    public function show_l_panel_data_fx(Request $request)
    {
        $finalQuery = CombinationModel::all();
        $html['finalCombination'] = "";
        $i = 0;
        foreach($finalQuery as $fQuery)
        {
            $mainQuery = PickPostLengthModel::where('id',$fQuery->combination_id)->get();
            if(count($mainQuery) > 0)
            {
                foreach($mainQuery as $mQuery)
                {
                    $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                    foreach($heightQuery as $hQuery)
                    {
                        $mainHeight = $hQuery->master_height_length;
                    }

                    $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                    foreach($widthQuery as $wQuery)
                    {
                        $mainWidth = $wQuery->master_width_length;
                    }

                    $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                    foreach($postQuery as $pQuery)
                    {
                        $mainPost = $pQuery->no_of_posts;
                    }

                    $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                    foreach($overHeadQuery as $ohQuery)
                    {
                        $mainOverhead = $ohQuery->overhead_shades_val;
                    }

                    $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                    foreach($postLengthQuery as $phQuery)
                    {
                        $mainPostLength = $phQuery->master_post_length;
                    }
                    $combination_html = $mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades";
                }

            
            }

            // mount price
            $new_price = $fQuery->new_price;
            $exist_price = $fQuery->existing_price;

            // canopy details
            $canopy_price = $fQuery->canopy_price;
            $canopy_details = $fQuery->canopy_list;

            // lpanel 
            $left_price = $fQuery->left_price;
            $right_price = $fQuery->right_price;
            $rear_price = $fQuery->rear_price;
            $left_rear_price = $fQuery->left_rear_price;
            $right_rear_price = $fQuery->right_rear_price;
            $left_right_rear_price = $fQuery->left_right_rear_price;

                if($fQuery->admin_action == 'yes' )
                {
                    $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$fQuery->admin_action.'",'.$fQuery->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                }
                else if($fQuery->admin_action == 'no' )
                {
                    $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$fQuery->admin_action.'",'.$fQuery->id.') class="btn btn-sm btn-success">Make it Active</a>';
                }
                else
                {

                }


                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$fQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$fQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';
            $html['finalCombination'] .= '<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$combination_html.'</td>
                                            <td>New Price : $'.$new_price.'<br/>Existing Price : $'.$exist_price.'</td>
                                            <td>Canopy Price : '.$canopy_price.'<br/>Canopy_details : '.$canopy_details.'</td>
                                            <td>Left Price : '.$left_price.'<br/> 
                                                right Price : '.$right_price.'<br/> 
                                                rear Price : '.$rear_price.'<br/>
                                                Left rear Price : '.$left_rear_price.'<br/>
                                                right rear Price : '.$right_rear_price.'<br/>
                                                Left right rear Price : '.$left_right_rear_price.'
                                            </td>
                                            <td>'.$status.'</td>
                                            <td>'.$action_btn.' '.$edit_state.' '.$del_state.'</td>
                                          </tr>';
        }

        echo json_encode($html);
    }

    public function edit_combination_panel(Request $request)
    {
        $edit_id = $_GET['id'];

        $finalQuery = CombinationModel::where('id',$edit_id)->get();
        foreach($finalQuery as $fQuery)
        {
            $mainQuery = PickPostLengthModel::get();
            if(count($mainQuery) > 0)
            {
                $html['combination_data'] = "<option value=''>choose combination</option>";
                foreach($mainQuery as $mQuery)
                {
                    $selected = "";
                    if($mQuery->id == $fQuery->combination_id)
                    {
                        $selected = "selected";
                    }
                    $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                    foreach($heightQuery as $hQuery)
                    {
                        $mainHeight = $hQuery->master_height_length;
                    }

                    $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                    foreach($widthQuery as $wQuery)
                    {
                        $mainWidth = $wQuery->master_width_length;
                    }

                    $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                    foreach($postQuery as $pQuery)
                    {
                        $mainPost = $pQuery->no_of_posts;
                    }

                    $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                    foreach($overHeadQuery as $ohQuery)
                    {
                        $mainOverhead = $ohQuery->overhead_shades_val;
                    }

                    $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                    foreach($postLengthQuery as $phQuery)
                    {
                        $mainPostLength = $phQuery->master_post_length;
                    }
                    $html['combination_data'] .= "<option value='".$mQuery->id."' ".$selected." >".$mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades</option>";
                }

            
            }


            // mount price
            $html['new_price'] = $fQuery->new_price;
            $html['exist_price'] = $fQuery->existing_price;

            // canopy details
            $html['canopy_price'] = $fQuery->canopy_price;
            $html['canopy_details'] = $fQuery->canopy_list;

            // lpanel 
            $html['left_price'] = $fQuery->left_price;
            $html['right_price'] = $fQuery->right_price;
            $html['rear_price'] = $fQuery->rear_price;
            $html['left_rear_price'] = $fQuery->left_rear_price;
            $html['right_rear_price'] = $fQuery->right_rear_price;
            $html['left_right_rear_price'] = $fQuery->left_right_rear_price;


        } 

        echo json_encode($html);
    }


    public function submit_combination_panel(Request $request, $my_data)
    {
        $combination_panel_val = $request->input('combination_name');

        $exist_price = $request->input('exist_price');
        $new_price = $request->input('new_price');

        $canopy_price = $request->input('canopy_price');
        $canopy_description = $request->input('canopy_description');

        $left_price = $request->input('left_price');
        $rear_price = $request->input('rear_price');
        $right_price = $request->input('right_price');
        $left_rear_price = $request->input('left_rear_price');
        $right_rear_price = $request->input('right_rear_price');
        $left_right_rear_price = $request->input('left_right_rear_price');

        $mainQuery = CombinationModel::where('id','!=',$my_data)->where('combination_id',$combination_panel_val)->get();
        if(count($mainQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else 
        {
            $insertArr = [
                'combination_id' => $combination_panel_val, 
                'existing_price' => $exist_price, 
                'new_price' => $new_price, 
                'canopy_list' => $canopy_description, 
                'canopy_price' => $canopy_price, 
                'left_price' => $left_price, 
                'right_price' => $rear_price, 
                'rear_price' => $right_price, 
                'left_rear_price' => $left_rear_price, 
                'right_rear_price' => $right_rear_price, 
                'left_right_rear_price' => $left_right_rear_price, 
                'created_at' => date('y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insertQuery = CombinationModel::where('id',$my_data)->update($insertArr);
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


    public function edit_combination_action_change(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = CombinationModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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

    public function del_combination_panel(Request $request)
    {
        $changeQuery = CombinationModel::where('id',$_GET['id'])->delete();
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
}
