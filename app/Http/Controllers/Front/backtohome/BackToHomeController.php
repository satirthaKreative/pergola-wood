<?php

namespace App\Http\Controllers\Front\backtohome;

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
use App\Model\Front\Billing_Model;
use App\Model\Front\Shipping_Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillingMail;
use App\Model\Admin\CombinationModel\CombinationModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterOverheadModel;
use App\Model\Admin\PaymentModel;


class BackToHomeController extends Controller
{
    public function show_thankyou_fx(Request $request)
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
        $billingMailQuery = Billing_Model::where('final_checkout_session_id',$get_session_data)->get();
        foreach($billingMailQuery as $billQuery)
        {
            $data['new_username'] = $billQuery->f_name." ".$billQuery->l_name;
            $data['new_useremail'] = $billQuery->email_address;
            $data['new_userOrderId'] = $billQuery->final_checkout_session_id;
            $data['new_billingAddress'] = "";
            if($billQuery->company_name != "" || $billQuery->company_name != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->company_name;
            }
            if($billQuery->street1_address != "" || $billQuery->street1_address != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->street1_address;
            }
            if($billQuery->street2_address != "" || $billQuery->street2_address != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->street2_address;
            }
            if($billQuery->city != "" || $billQuery->city != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->city;
            }
            if($billQuery->state != "" || $billQuery->state != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->state;
            }
            if($billQuery->country != "" || $billQuery->country != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->country;
            }
            if($billQuery->zipcode != "" || $billQuery->zipcode != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->zipcode;
            }
        }

        $shippingMailQuery = Shipping_Model::where('final_checkout_session_id',$get_session_data)->get();
        foreach($shippingMailQuery as $shippingQuery)
        {
            $data['new_shippingAddress'] = "";
            if($shippingQuery->company_name != "" || $shippingQuery->company_name != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->company_name;
            }
            if($shippingQuery->street1_address != "" || $shippingQuery->street1_address != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->street1_address;
            }
            if($shippingQuery->street2_address != "" || $shippingQuery->street2_address != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->street2_address;
            }
            if($shippingQuery->city != "" || $shippingQuery->city != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->city;
            }
            if($shippingQuery->state != "" || $shippingQuery->state != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->state;
            }
            if($shippingQuery->country != "" || $shippingQuery->country != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->country;
            }
            if($shippingQuery->zipcode != "" || $shippingQuery->zipcode != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->zipcode;
            }
        }
            
        // Mail::to($data['new_useremail'])->send(new BillingMail($data));

        
        
        if($request->session()->has('main_back_session_key'))
        {
            $request->session()->forget('main_back_session_key');
        }
        return view('frontend.pages.thank-you');
    }
    //// payment order details
    public function payment_order_admin_fx(Request $request)
    {
        $session_user_id = "";

        if($request->session()->has('main_unique_session_key'))
        {
            $session_user_id = $request->session()->get('main_unique_session_key');
        }

        $order_id = $_GET['order_id'];
        $full_price = $_GET['full_price'];
        $payment_type = $_GET['payment_type'];

        $insertArr = [
            'order_details_id' => $order_id, 
            'user_id' => $session_user_id, 
            'pay_state' => 'yes', 
            'pay_flow_status' => "processing", 
            'admin_status' => 'active', 
            'created_at' => date('Y-m-d H:i:sa'),
            'updated_at' => date('Y-m-d H:i:sa'),
        ];

        $insertQuery = PaymentModel::insert($insertArr);
        if($insertQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }


        if($request->session()->has('main_unique_session_key'))
        {
            $request->session()->forget('main_unique_session_key');
        }
        echo json_encode($msg);
    }

    //// error page
    public function show_errorpage_fx(Request $request)
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
        $billingMailQuery = Billing_Model::where('final_checkout_session_id',$get_session_data)->get();
        foreach($billingMailQuery as $billQuery)
        {
            $data['new_username'] = $billQuery->f_name." ".$billQuery->l_name;
            $data['new_useremail'] = $billQuery->email_address;
            $data['new_userOrderId'] = $billQuery->final_checkout_session_id;
            $data['new_billingAddress'] = "";
            if($billQuery->company_name != "" || $billQuery->company_name != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->company_name;
            }
            if($billQuery->street1_address != "" || $billQuery->street1_address != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->street1_address;
            }
            if($billQuery->street2_address != "" || $billQuery->street2_address != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->street2_address;
            }
            if($billQuery->city != "" || $billQuery->city != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->city;
            }
            if($billQuery->state != "" || $billQuery->state != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->state;
            }
            if($billQuery->country != "" || $billQuery->country != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->country;
            }
            if($billQuery->zipcode != "" || $billQuery->zipcode != null)
            {
                $data['new_billingAddress'] .= " ".$billQuery->zipcode;
            }
        }

        $shippingMailQuery = Shipping_Model::where('final_checkout_session_id',$get_session_data)->get();
        foreach($shippingMailQuery as $shippingQuery)
        {
            $data['new_shippingAddress'] = "";
            if($shippingQuery->company_name != "" || $shippingQuery->company_name != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->company_name;
            }
            if($shippingQuery->street1_address != "" || $shippingQuery->street1_address != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->street1_address;
            }
            if($shippingQuery->street2_address != "" || $shippingQuery->street2_address != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->street2_address;
            }
            if($shippingQuery->city != "" || $shippingQuery->city != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->city;
            }
            if($shippingQuery->state != "" || $shippingQuery->state != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->state;
            }
            if($shippingQuery->country != "" || $shippingQuery->country != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->country;
            }
            if($shippingQuery->zipcode != "" || $shippingQuery->zipcode != null)
            {
                $data['new_shippingAddress'] .= " ".$shippingQuery->zipcode;
            }
        }
            
        Mail::to($data['new_useremail'])->send(new BillingMail($data));

        
        if($request->session()->has('main_unique_session_key'))
        {
            $request->session()->forget('main_unique_session_key');
        }
        if($request->session()->has('main_back_session_key'))
        {
            $request->session()->forget('main_back_session_key');
        }
        return view('frontend.pages.error-page');
    }
    //// end payment order details

    public function index(Request $request)
    {
        $request->session()->put('main_back_session_key', "backSession");
        echo json_encode("success");
    }

    public function forget_s_fx(Request $request)
    {
        if($request->session()->has('main_back_session_key'))
        {
            $request->session()->forget('main_back_session_key');
        }
        echo json_encode("success");
    }

    public function showPageRequest(Request $request)
    {
        $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
        foreach($mQuery_check as $mQc)
        {

            /// get final price 
            $html['final_main_product_price'] = $mQc->final_price;

            /// get height
            $get_height_query = MasterHeightModel::where('id',$mQc->final_length)->get();
            foreach($get_height_query as $gHq)
            {
                $html['final_main_height'] = $gHq->master_height_length;
            }

            /// get width
            $get_width_query = MasterWidthModel::where('id',$mQc->final_width)->get();
            foreach($get_width_query as $gWq)
            {
                $html['final_main_width'] = $gWq->master_width_length;
            }


            /// first page
            $master_new_width = $mQc->final_width;
            $master_new_length = $mQc->final_length;
            $master_new_no_of_posts = $mQc->final_no_posts;
            
            $check_price = PickUpFootPrintModel::where(['width_master' => $master_new_width, 'height_master' => $master_new_length, 'posts_master' => $master_new_no_of_posts ])->get();
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


            /// second page
            $secondQueryPage = PickOverheadShadesModel::where(['id' => $mQc->final_overhead])->get();
            foreach($secondQueryPage as $sQp)
            {
                // final  loop
                $findQuery = PickOverheadShadesModel::where('admin_action','yes')->get();
                $html['overhead_types'] = "<option value=''>Choose a overhead shades</option>";
                foreach($findQuery as $fQuery)
                {
                    $checked = "";
                    if($fQuery->id == $sQp->id)
                    {
                        $checked = "selected";
                    }
                    $html['overhead_types'] .= "<option value=".$fQuery->id." ".$checked.">".$fQuery->img_standard_name."</option>";
                }
                // end of final loop
                $html['second_page_price'] = $sQp->price_details;
                if($sQp->img_file == "" || $sQp->img_file == null)
                {
                    $html['master_second_img'] = '';
                }
                else
                {
                    $html['master_second_img'] = '<img src="'.str_replace("public","storage/app/public",asset($sQp->img_file)).'" src="no image" />';
                }
            }

            /// fourth page
            $thirdQueryPage = PickPostLengthModel::where(['id' => $mQc->final_post_length])->get();
            foreach($thirdQueryPage as $sQp)
            {
                // final  loop
                $findQuery = PickPostLengthModel::where('admin_action','yes')->get();
                $html['post_length'] = "<option value=''>Choose a overhead shades</option>";
                foreach($findQuery as $fQuery)
                {
                    $checked = "";
                    if($fQuery->id == $sQp->id)
                    {
                        $checked = "selected";
                    }
                    $html['post_length'] .= "<option value=".$fQuery->id." ".$checked.">".$fQuery->posts_length."</option>";
                }
                // end of final loop
                $html['third_page_price'] = $sQp->price_details;
                if($sQp->img_file == "" || $sQp->img_file == null)
                {
                    $html['master_third_img'] = '';
                }
                else
                {
                    $html['master_third_img'] = '<img src="'.str_replace("public","storage/app/public",asset($sQp->img_file)).'" src="no image" />';
                }
            }

            /// fifth page
            if($mQc->final_post_mount_type == "yes")
            {
                $html['pick_post_mount_status'] = "yes";
                $fifthfindQuery =  PickPostMountBracketModel::where('id',$mQc->final_post_mount)->get();
                foreach($fifthfindQuery as $fifthNewQuery)
                {
                    $html['pick_post_mount'] = '<option value="">Choose a pick slap</option>';
                    $chooseQuery = PickPostMountBracketModel::get();
                    
                        foreach($chooseQuery as $cQuery)
                        {    
                            $checked = "";
                            if($cQuery->id == $mQc->final_post_mount)
                            {
                                $checked = "selected";
                            }
                            $html['pick_post_mount'] .= '<option value='.$cQuery->id.' '.$checked.'>'.$cQuery->pick_slap_name.'</option>';
                        }
                    $html['pick_post_mount_price'] = $fifthNewQuery->price_details;
                }
            }
            else if($mQc->final_post_mount_type == "no")
            {
                $html['pick_post_mount_status'] = "no";
            }

            /// sixth page
            if($mQc->final_canopy_type == "yes")
            {
                $html['pick_canopy_status'] = "yes";
                $sixthfindQuery =  PickCanopyModel::get();
                foreach($sixthfindQuery as $sixNewQuery)
                {
                    $html['pick_canopy_mount'] = '<p>'.ucwords($sixNewQuery->canopy_question).'</p>
                    <p>Note: '.$sixNewQuery->canopy_note.'</p>
                    <input type="hidden" name="" id="sixth-pregenerated-price-hidden-val-id" value="'.$sixNewQuery->canopy_price.'" />
                    <h4>Price <span>$<span id="sixth-price-panel-id">'.$sixNewQuery->canopy_price.'</span></span></h4>';
                    $html['price_canopy'] = $sixNewQuery->canopy_price;
                }
            }
            else if($mQc->final_canopy_type == "no")
            {
                $html['pick_canopy_status'] = "no";
            }

            /// seventh page
            if($mQc->final_lpanel_type == "yes")
            {
                $html['pick_lpanel_status'] = "yes";
                $chooseQuery = PickLouveredPanelModel::where(['admin_action' => 'yes'])->get();
                $html['lpanel_radio_panel'] = "";
                if(count($chooseQuery) > 0)
                {
                    foreach($chooseQuery as $cQuery)
                    {
                        $checking_Checked = PickLouveredPanelModel::where(['admin_action' => 'yes', 'id' => $mQc->final_lpanel ])->get();
                        foreach($checking_Checked as $c_new_price)
                        {
                            $got_new_id = $c_new_price->id;
                        }

                        $checking_var = "";
                        if($cQuery->id == $got_new_id)
                        {
                            $checking_var = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery->l_panel_price.'") '.$checking_var.'> '.$cQuery->l_panel_name.'</li>';
                    }

                        $checking_Checked_query = PickLouveredPanelModel::where(['admin_action' => 'yes', 'id' => $mQc->final_lpanel])->orderBy('id','asc')->limit(1)->get();
                        foreach($checking_Checked_query as $c_new_price1)
                        {
                            $html['new_price'] = $c_new_price1->l_panel_price;
                        }
                }
            }
            else if($mQc->final_lpanel_type == "no")
            {
                $html['pick_lpanel_status'] = "no";
            }
            

            echo json_encode($html);
        }
    }

    /// back to home page session query
    public function backingRequestQuery(Request $request)
    {
        if($request->session()->has('main_unique_session_key'))
        {
            $get_session_data = $request->session()->get('main_unique_session_key');
        }


        $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
        foreach($mainQuery as $mQuery)
        {
            $masterWidth = $mQuery->final_width;
            $masterHeight = $mQuery->final_length;
            $masterPost = $mQuery->final_no_posts;


            // first page 
            $choose_post_type_query = PickUpFootPrintModel::where(['height_master' => $masterHeight, 'width_master' => $masterWidth ])->get();
            $array_post_names = array();
            foreach($choose_post_type_query as $choosePostTypeQ)
            {
                $array_post_names[] = $choosePostTypeQ->posts_master;
            }
            
            $mainPostQuery = PillerPostModel::whereIn('id',$array_post_names)->get();

            
                $html['main_posts'] = '<option value="">Choose posts</option>';
                if(count($mainPostQuery) > 0)
                {
                    foreach($mainPostQuery as $pQuery)
                    {
                        $checked = "";
                        if($pQuery->id == $masterPost)
                        {
                            $checked = "selected";
                        }
                        $html['main_posts'] .= '<option value='.$pQuery->id.' '.$checked.'>'.$pQuery->no_of_posts.' posts</option>';
                    }
                }

            $getting_first_page_image_price_query = PickUpFootPrintModel::where(['height_master' => $masterHeight, 'width_master' => $masterWidth, 'posts_master' => $masterPost])->get();
            foreach($getting_first_page_image_price_query as $gTQuery1)
            {
                $html['master_price'] = $gTQuery1->price_master;
                $html['master_img'] = '';
                        if($gTQuery1->img_master != "" || $gTQuery1->img_master != null)
                        {
                            $html['master_img'] = '<img src="'.str_replace("public","storage/app/public",asset($gTQuery1->img_master)).'" src="no image" />';
                        }
                        else if($gTQuery1->img_master == "" || $gTQuery1->img_master == null)
                        {
                            $html['master_img'] = '';
                        }
            }

            // end of first page
            $final_msg_overhead =  $mQuery->final_overhead;$html['hed_over'] = $final_msg_overhead;$final_msg_post_length = $mQuery->final_post_length; $final_post_mount_type = $mQuery->final_post_mount_type; $final_post_mount = $mQuery->final_post_mount; $final_canopy_price = $mQuery->final_canopy; $final_canopy_type = $mQuery->final_canopy_type; $final_lpanel_type = $mQuery->final_lpanel_type; $final_lpanel_price = $mQuery->final_lpanel; $final_own_new_product = $mQuery->final_price;
            // second page
            $secondPageData = PickOverheadShadesModel::where(['master_width' => $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost])->get();
            $html['overhead_types'] = "<option value=''>Choose a overhead shades</option>";
            foreach($secondPageData as $secondQuery)
            {
                $fetchTheFinalOne = MasterOverheadModel::where(['id' => $secondQuery->master_overhead_shades])->get();
                foreach($fetchTheFinalOne as $fTOne){
                    $checked = "";
                    if($fTOne->id == $final_msg_overhead)
                    {
                        $checked = "selected";
                    }
                    $html['overhead_types'] .= "<option value=".$fTOne->id." ".$checked.">".$fTOne->overhead_shades_val."</option>";
                }
            }
            

            $getting_second_page_image_price_query = PickOverheadShadesModel::where(['master_width' => $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $mQuery->final_overhead])->get();
            foreach($getting_second_page_image_price_query as $gTQuery2)
            {
                $html['master_overhead_price'] = $gTQuery2->price_details;
                $html['master_overhead_img'] = '';
                        if($gTQuery2->img_file != "" || $gTQuery2->img_file != null)
                        {
                            $html['master_overhead_img'] = '<img src="'.str_replace("public","storage/app/public",asset($gTQuery2->img_file)).'" src="no image" />';
                        }
                        else if($gTQuery2->img_file == "" || $gTQuery2->img_file == null)
                        {
                            $html['master_overhead_img'] = '';
                        }
            }

            // third page
            $mainVideoQuery = Video3DModel::where(['master_width' => $masterWidth , 'master_height' => $masterHeight, 'master_posts' => $masterPost , 'master_overhead' => $mQuery->final_overhead ])->get();
        
       
            if(count($mainVideoQuery) > 0)
            {
                $i = 0;
                foreach($mainVideoQuery as $mQuery)
                {
                    if($mQuery->master_3D_video != "" || $mQuery->master_3D_video != null)
                    {
                        $html['video_data'] = $mQuery->master_3D_video;
                    }
                    else
                    {
                        $html['video_data'] = "";
                    }
                    
                }
            }
            else
            {
                $html['video_data'] = "";
            } 

            /// fourth page
            $choosePostLengthQuery = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' =>  $final_msg_overhead])->get();
            $html['master_post_length'] = '<option value="">Choose a post length</option>';
            $html['hvguveug'] = $masterWidth." ".$masterHeight." ".$masterPost." ".$final_msg_overhead." ";
            if(count($choosePostLengthQuery) > 0)
            {
                foreach($choosePostLengthQuery as $cQuery1)
                {    
                    
                    $fetchTheFinalOne = MasterPostLengthModel::where(['id' => $cQuery1->posts_length])->get();
                    
                    foreach($fetchTheFinalOne as $fQueryLenght)
                    {
                        $checked = "";
                        if($fQueryLenght->id == $final_msg_post_length)
                        {
                            $checked = "selected";
                        }
                        $html['master_post_length'] .= '<option value='.$fQueryLenght->id.' '.$checked.'>'.$fQueryLenght->master_post_length.' ft.</option>';
                    }
                }
            }

            $getting_fifth_page_image_price_query = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $final_msg_overhead, 'posts_length' => $final_msg_post_length ])->get();
            foreach($getting_fifth_page_image_price_query as $gTQuery5)
            {
                $html['master_post_length_price'] = $gTQuery5->price_details;
                $html['master_post_length_img'] = '';
                        if($gTQuery5->img_file != "" || $gTQuery5->img_file != null)
                        {
                            $html['master_post_length_img'] = '<img src="'.str_replace("public","storage/app/public",asset($gTQuery5->img_file)).'" src="no image" />';
                        }
                        else if($gTQuery5->img_file == "" || $gTQuery5->img_file == null)
                        {
                            $html['master_post_length_img'] = '';
                        }
            }

            // fifth page
            $chooseSlapQuery = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $final_msg_overhead, 'posts_length' => $final_msg_post_length ])->get();
            $html['choose_pick_slap_html'] = '<option value="">Choose a pick slap</option>';
            if(count($chooseSlapQuery) > 0)
            {
                $checked = "";
                foreach($chooseSlapQuery as $cQuery)
                {    
                    $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

                    foreach($chooseMainQuery as $cQuery1)
                    {
                        
                        $html['final_post_mount_type'] = $final_post_mount_type;

                        if($final_post_mount_type == "yes")
                        {
                            $html['final_post_mount'] = $final_post_mount;
                            $selected = "";
                            if($cQuery1->new_price == $final_post_mount)
                            {
                                $selected = "selected";
                            }
                            else
                            {
                                $selected = "";
                            }
                            $html['choose_pick_slap_html']  .= '<option value='.$cQuery1->new_price.' '.$selected.'>New Price</option>';
                            if($cQuery1->existing_price == $final_post_mount)
                            {
                                $selected = "selected";
                            }
                            else
                            {
                                $selected = "";
                            }
                            $html['choose_pick_slap_html']  .= '<option value='.$cQuery1->existing_price.' '.$selected.'>Existing Price</option>';
                        }
                        
                    }

                    
                }
            }

            // sixth page
            $chooseCanopySessionQuery = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $final_msg_overhead, 'posts_length' => $final_msg_post_length ])->get();
            $html['canopy_session_name'] = '';
            if(count($chooseCanopySessionQuery) > 0)
            {
                $checked = "";
                    
                foreach($chooseCanopySessionQuery as $cQuery)
                {    
                    $html['show_canopy_type'] = $final_canopy_type;
                    if($final_canopy_type == "yes")
                    {
                        $html['show_canopy_name_price'] = $final_canopy_price;
                        $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

                        foreach($chooseMainQuery as $cQuery1)
                        {
                            $html['canopy_session_name'] .= '<p>'.ucwords($cQuery1->canopy_list).'</p>
                            <input type="hidden" name="" id="sixth-pregenerated-price-hidden-val-id" value="'.$cQuery1->canopy_price.'" />
                            <h4>Price <span>$<span id="sixth-price-panel-id">'.$cQuery1->canopy_price.'</span></span></h4>';
                        }
                    }
                    

                }
            }

            // seventh page
            $chooseLpanelQuery = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $final_msg_overhead, 'posts_length' => $final_msg_post_length ])->get();
            $html['lpanel_radio_panel'] = "";
            if(count($chooseLpanelQuery) > 0)
            {
                $checked = "";
                    
                foreach($chooseLpanelQuery as $cQuery)
                {    
                    
                    $html['show_lpanel_type'] = $final_lpanel_type;
                    if($final_lpanel_type == "yes"){
                    $html['show_lpanel_name_price'] = $final_lpanel_price;
                    $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();
                    
                    

                    foreach($chooseMainQuery as $cQuery1)
                    {
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->left_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" '.$checked.' onclick=my_seveth_click("'.$cQuery1->left_price.'") > Left </li>';
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->rear_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio" '.$checked.'  name="bracket" onclick=my_seveth_click("'.$cQuery1->rear_price.'") > Rear</li>';
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->right_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio" '.$checked.'  name="bracket" onclick=my_seveth_click("'.$cQuery1->right_price.'") > Right </li>';
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->left_rear_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio"  '.$checked.'  name="bracket" onclick=my_seveth_click("'.$cQuery1->left_rear_price.'") > Left + Rear</li>';
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->right_rear_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio"  '.$checked.'  name="bracket" onclick=my_seveth_click("'.$cQuery1->right_rear_price.'") > Right + Rear</li>';
                        $checked = "";
                        if($final_lpanel_price == $cQuery1->left_right_rear_price)
                        {
                            $checked = "checked";
                        }
                        $html['lpanel_radio_panel'] .= '<li><input type="radio"   '.$checked.'  name="bracket" onclick=my_seveth_click("'.$cQuery1->left_right_rear_price.'") > Left + Right + Rear</li>';

                    }

                  }

                }
            }


            ///
            $html['mount_new_panel_type'] = $final_post_mount_type;
            $html['canopy_new_panel_type'] = $final_canopy_type;
            $html['final_new_lpanel_type'] = $final_lpanel_type;
            $html['final_home_price_due'] = $final_own_new_product;


            /// final page product
            $chooseFinalProductQuery = PickPostLengthModel::where(['master_width' =>  $masterWidth, 'master_height' => $masterHeight, 'master_post' => $masterPost, 'master_overhead_shades' => $final_msg_overhead, 'posts_length' => $final_msg_post_length ])->get();
            $html['choose_final_product_details'] = "";
            foreach($chooseFinalProductQuery as $cHLPQuery)
            {
                $piller_count_query = PillerPostModel::where('id',$cHLPQuery->master_post)->get();
                foreach($piller_count_query as $pillerQuery)
                {
                    $html['posts_no3'] = $pillerQuery->no_of_posts;
                }

                $master_width_query = MasterWidthModel::where('id',$cHLPQuery->master_width)->get();
                foreach($master_width_query as $widthQuery)
                {
                    $html['width_data3'] = $widthQuery->master_width_length;
                }

                $master_height_query = MasterHeightModel::where('id',$cHLPQuery->master_height)->get();
                foreach($master_height_query as $heightQuery)
                {
                    $html['height_data3'] = $heightQuery->master_height_length;
                }

                $master_final_product_page_query = FinalProductModel::where('pick_footprint',$cHLPQuery->id)->get();
                if(count($master_final_product_page_query) > 0)
                {
                    foreach($master_final_product_page_query as $finalPQuery)
                    {
                        $html['final_prod_img3'] = "";
                        $html['final_footprint_img3'] = "";
                        if($finalPQuery->final_product_img != "" || $finalPQuery->final_product_img != null){
                            $html['final_prod_img3'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_product_img)).'"  alt=""/>';
                        }
                        if($finalPQuery->final_footprint_img != "" || $finalPQuery->final_footprint_img != null){
                            $html['final_footprint_img3'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_footprint_img)).'"  alt=""/>';
                        }
                    }
                }

                $post_length_query = MasterPostLengthModel::where('id',$cHLPQuery->posts_length)->get();
                foreach($post_length_query as $pQuery)
                {
                    $html['length_data3'] = $pQuery->master_post_length;
                }

                $overhead_query = MasterOverheadModel::where('id',$cHLPQuery->master_overhead_shades)->get();
                foreach($overhead_query as $pOverQuery)
                {
                    $html['overhead_data3'] = $pOverQuery->overhead_shades_val;
                }
            }

            

        }

        echo json_encode($html);
    }
}
