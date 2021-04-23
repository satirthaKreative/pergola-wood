<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Video3D\Video3DModel;
use App\Model\Admin\PickCanopy\PickCanopyModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;
use App\Model\Front\BeforeCheckoutFinalProductModel;
use App\Model\Admin\FinalProduct\FinalProductModel;
use App\Model\Admin\CombinationModel\CombinationModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterOverheadModel;

class MainHomeController extends Controller
{
    //
    public function index(Request $request)
    {
        
        return view('frontend.layouts.home');
    }

    // master width view
    public function choose_master_width_fx(Request $request)
    {
        
        $widthQuery = MasterWidthModel::get();
        $html = '<option value="">Choose a width</option>';
        if(count($widthQuery) > 0)
        {
            
            
            foreach($widthQuery as $wQuery)
            {

                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_width == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->master_width_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    // main home
    public function show_3d_video_fx3(Request $request)
    {
        $mainQuery = Video3DModel::where(['master_width' => $_GET['master_width'] , 'master_height' => $_GET['master_height'], 'master_posts' => $_GET['master_post'] , 'master_overhead' => $_GET['overhead_val'] ])->get();
        
       
        if(count($mainQuery) > 0)
        {
            $i = 0;
            foreach($mainQuery as $mQuery)
            {
                if($mQuery->master_3D_video != "" || $mQuery->master_3D_video != null)
                {
                    $video_data = $mQuery->master_3D_video;
                }
                else
                {
                    $video_data = "";
                }
                
            }
        }
        else
        {
            $video_data = "";
        } 

        echo json_encode($video_data);
    }

    // master height view
    public function choose_master_height_fx(Request $request)
    {
        $widthQuery = MasterHeightModel::get();
        $html = '<option value="">Choose a length</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_length == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->master_height_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    // master posts view
    public function choose_master_post_fx(Request $request)
    {
        $choose_post_type_query = PickUpFootPrintModel::where(['height_master' => $_GET['master_height_name'], 'width_master' => $_GET['master_width_name'] ])->get();
        $array_post_names = array();
        foreach($choose_post_type_query as $choosePostTypeQ)
        {
            $array_post_names[] = $choosePostTypeQ->posts_master;
        }
        
        $widthQuery = PillerPostModel::whereIn('id',$array_post_names)->get();

        
        $html = '<option value="">Choose posts</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_no_posts == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->no_of_posts.' posts</option>';
            }
        }
        echo json_encode($html);
    }

    // change width look
    public function change_master_width_fx(Request $request)
    {
        $widthQuery = MasterWidthModel::where('id',$_GET['id'])->get();
        foreach($widthQuery as $wQ)
        {
            $main_data = $wQ->master_width_length;
        }
        echo json_encode($main_data);
    }

    // change height look
    public function change_master_height_fx(Request $request)
    {
        $widthQuery = MasterHeightModel::where('id',$_GET['id'])->get();
        foreach($widthQuery as $wQ)
        {
            $main_data = $wQ->master_height_length;
        }
        echo json_encode($main_data);
    }

    // price wish combination look
    public function choose_master_post_wish_price_fx(Request $request)
    {
        
        $check_price = PickUpFootPrintModel::where(['width_master' => $_GET['master_width'], 'height_master' => $_GET['master_height'], 'posts_master' => $_GET['master_post'] ])->get();
        
        
        $html['master_price'] = 0;
        $html['master_img'] = '';
        if(count($check_price) > 0)
        {
            foreach($check_price as $cQuery)
            {
                $html['master_price'] = $cQuery->price_master;
                if($cQuery->img_master != "" || $cQuery->img_master != null)
                {
                    $html['master_img'] = '<img src="'.str_replace("public","storage/app/public",asset($cQuery->img_master)).'" src="no image" />';
                }
                else if($cQuery->img_master == "" || $cQuery->img_master == null)
                {
                    $html['master_img'] = '';
                }
            }
        }
        echo json_encode($html);
    }

    // end of first page


    /// For second page data's

    public function show_overheads_fx2(Request $request)
    {
        $findQuery = PickOverheadShadesModel::where(['master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post']])->get();
        $html['overhead_types'] = "<option value=''>Choose a overhead shades</option>";
        if(count($findQuery) > 0)
        {
            
            foreach($findQuery as $fQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_overhead == $fQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }

                
                $gettingQuery = MasterOverheadModel::where('id',$fQuery->master_overhead_shades)->get();
                foreach($gettingQuery as $gQuery)
                {
                    $html['overhead_types'] .= "<option value=".$gQuery->id." ".$checked.">".$gQuery->overhead_shades_val."</option>";
                }
            }
        }
        echo json_encode($html);
    }

    public function choose_overheads_fx2(Request $request)
    {
        $findQuery = PickOverheadShadesModel::where(['admin_action' => 'yes', 'master_overhead_shades' => $_GET['id'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'],'master_post' => $_GET['master_post'] ])->get();
        $html['overhead_price'] = 0;
        if(count($findQuery) > 0)
        {
            foreach($findQuery as $fQuery)
            {
                $html['overhead_price'] = $fQuery->price_details;
                if($fQuery->img_file == null || $fQuery->img_file == '')
                {
                    $html['overhead_img'] = '';
                }
                else if($fQuery->img_file != null || $fQuery->img_file != '')
                {
                    $html['overhead_img'] = '<img src="'.str_replace("public","storage/app/public",asset($fQuery->img_file)).'" src="no image" />';
                }
                
            }
        }
        echo json_encode($html);
    }

    /// end of Second page

    // start of fourth page
    public function show_pick_post_length_fx4(Request $request)
    {
        $chooseQuery = PickPostLengthModel::where(['master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store']])->get();
        $html = '<option value="">Choose a post length</option>';
        if(count($chooseQuery) > 0)
        {
            foreach($chooseQuery as $cQuery)
            {    
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_post_length == $cQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $fetchTheFinalOne = MasterPostLengthModel::where(['id' => $cQuery->posts_length])->get();
                foreach($fetchTheFinalOne as $fQueryLenght)
                {
                    $html .= '<option value='.$fQueryLenght->id.' '.$checked.'>'.$fQueryLenght->master_post_length.' ft.</option>';
                }
            }
        }
        echo json_encode($html);
    }

    public function choose_pick_post_length_fx4(Request $request)
    {
        $master_width = $_GET['master_width']; $master_height = $_GET['master_height']; $master_post = $_GET['master_post']; $overhead_val = $_GET['overhead_val'];
        $chooseSessionCallQuery = PickPostLengthModel::where(['admin_action' => 'yes',  'posts_length' => $_GET['id'], 'master_width' => $master_width, 'master_height' => $master_height, 'master_post' => $master_post, 'master_overhead_shades' => $overhead_val])->get();
        {
            foreach($chooseSessionCallQuery as $chooseSCallQuery)
            {
                $get_main_post_tbl_id = $chooseSCallQuery->id;
                $request->session()->put('final_product_combination_session_id', $get_main_post_tbl_id);
            }
        }
        $chooseQuery = PickPostLengthModel::where(['admin_action' => 'yes', 'id' => $_GET['id']])->get();
        
        if(count($chooseQuery) > 0)
        {
            foreach($chooseQuery as $cQuery)
            {    
                $html['fourth_price'] = $cQuery->price_details;
                if($cQuery->img_file == null || $cQuery->img_file == "")
                {
                    $html['fourth_img'] = '';
                }
                else if($cQuery->img_file != null || $cQuery->img_file != "")
                {
                    $html['fourth_img'] = '<img src="'.str_replace("public","storage/app/public",asset($cQuery->img_file)).'" src="no image" />';
                }
            }
        }
        echo json_encode($html);
    }
    // end of fourth page

    // fifth start page
    public function show_pick_post_mount_fx5(Request $request)
    {
       
        $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'] ])->get();
        $html = '<option value="">Choose a pick slap</option>';
        if(count($chooseQuery) > 0)
        {
            $checked = "";
                
            foreach($chooseQuery as $cQuery)
            {    

                $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

                foreach($chooseMainQuery as $cQuery1)
                {
                    $html .= '<option value='.$cQuery1->new_price.'>New Price</option>';
                    $html .= '<option value='.$cQuery1->existing_price.'>Existing Price</option>';
                }

                // if($request->session()->has('main_unique_session_key'))
                // {
                //     $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                //     foreach($mQuery_check as $mQc)
                //     {
                //         if($mQc->final_post_mount == $cQuery->id)
                //         {
                //             $checked = "selected";
                //         }
                        
                //     }
                // }
                
            }
        }
        echo json_encode($html);
    }

    public function choose_pick_post_mount_fx5(Request $request)
    {
        $chooseQuery = PickPostMountBracketModel::where(['id' => $_GET['id'] ,'admin_action' => 'yes'])->get();
        foreach($chooseQuery as $cQuery)
        {
            $html['price_list'] = $cQuery->price_details;
        }
        echo json_encode($html);
    }
    // end of fifth page

    // start of sixth page
    public function show_pick_canopy_fx6(Request $request)
    {
        $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'] ])->get();
        $html = '';
        if(count($chooseQuery) > 0)
        {
            $checked = "";
                
            foreach($chooseQuery as $cQuery)
            {    

                $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

                foreach($chooseMainQuery as $cQuery1)
                {
                    $html .= '<p>'.ucwords($cQuery1->canopy_list).'</p>
                    <input type="hidden" name="" id="sixth-pregenerated-price-hidden-val-id" value="'.$cQuery1->canopy_price.'" />
                    <h4>Price <span>$<span id="sixth-price-panel-id">'.$cQuery1->canopy_price.'</span></span></h4>';
                }

            }
        }
        echo json_encode($html);
    }
    // start of sixth page

    // start of seventh page
    public function show_pick_lpanel_fx7(Request $request)
    {

        $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'] ])->get();
        $html['lpanel_radio_panel'] = "";
        if(count($chooseQuery) > 0)
        {
            $checked = "";
                
            foreach($chooseQuery as $cQuery)
            {    

                $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();
                
                

                foreach($chooseMainQuery as $cQuery1)
                {
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" checked onclick=my_seveth_click("'.$cQuery1->left_price.'") > Left </li>';
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->rear_price.'") > Rear</li>';
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->right_price.'") > Right </li>';
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->left_rear_price.'") > Left + Rear</li>';
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->right_rear_price.'") > Right + Rear</li>';
                    $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->left_right_rear_price.'") > Left + Right + Rear</li>';

                    $html['new_price'] = $cQuery1->left_price;
                }

            }
        }


        echo json_encode($html);
    }
    // end of seventh page

    // final page
    public function showFinalPage(Request $request)
    {
        $master_width = $_GET['master_width'];
        $master_height = $_GET['master_height']; 
        $master_post = $_GET['master_post'];
        $overhead_type_val = $_GET['overhead_type_val'];
        $post_length_val = $_GET['post_length_val'];


        $piller_count_query = PillerPostModel::where('id',$master_post)->get();
        foreach($piller_count_query as $pillerQuery)
        {
            $html['posts_no'] = $pillerQuery->no_of_posts;
        }

        $master_width_query = MasterWidthModel::where('id',$master_width)->get();
        foreach($master_width_query as $widthQuery)
        {
            $html['width_data'] = $widthQuery->master_width_length;
        }

        $master_height_query = MasterHeightModel::where('id',$master_height)->get();
        foreach($master_height_query as $heightQuery)
        {
            $html['height_data'] = $heightQuery->master_height_length;
        }

        $master_final_product_page_query = FinalProductModel::where('pick_footprint',$request->session()->get('final_product_combination_session_id'))->get();
        if(count($master_final_product_page_query) > 0)
        {
            foreach($master_final_product_page_query as $finalPQuery)
            {
                $html['final_prod_img'] = "";
                $html['final_footprint_img'] = "";
                if($finalPQuery->final_product_img != "" || $finalPQuery->final_product_img != null){
                    $html['final_prod_img'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_product_img)).'"  alt=""/>';
                }
                if($finalPQuery->final_footprint_img != "" || $finalPQuery->final_footprint_img != null){
                    $html['final_footprint_img'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_footprint_img)).'"  alt=""/>';
                }
            }
        }

        $post_length_query = MasterPostLengthModel::where('id',$post_length_val)->get();
        foreach($post_length_query as $pQuery)
        {
            $html['length_data'] = $pQuery->master_post_length;
        }

        $overhead_query = MasterOverheadModel::where('id',$overhead_type_val)->get();
        foreach($overhead_query as $pOverQuery)
        {
            $html['overhead_data'] = $pOverQuery->overhead_shades_val;
        }

        echo json_encode($html);

    }
    // end of final page
}