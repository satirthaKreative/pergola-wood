<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Model\Front\Billing_Model;
use App\Model\Front\Shipping_Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Model\Front\BeforeCheckoutFinalProductModel;


class PaymentHomeController extends Controller
{
    //
    public function showPage(Request $request)
    {
        return view('frontend.pages.payment');
    }

    public function get_final_pricelist(Request $request)
    {
        if($request->session()->has('main_unique_session_key'))
        {
            $get_session_data = $request->session()->get('main_unique_session_key');
        }
        $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
        foreach($mainQuery as $mQuery)
        {
            $get_price_range = $mQuery->final_price;
        }

        echo json_encode($get_price_range);
    }

    public function getDataFx(Request $request)
    {
        if($_GET['pay_state_status'] == "yes")
        {
            if($request->session()->has('main_unique_session_key'))
            {
                $get_session_data = $request->session()->get('main_unique_session_key');
            }
            $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
            foreach($mainQuery as $mQuery)
            {
                $final_check_id  = $mQuery->id;
            }
            $insertArr = [
                'final_checkout_id' => $final_check_id, 
                'final_checkout_session_id' => $get_session_data, 
                'f_name' => $_GET['first_name'], 
                'l_name' => $_GET['last_name'], 
                'company_name' => $_GET['company_name'], 
                'street1_address' => $_GET['street1_name'], 
                'street2_address' => $_GET['street2_name'], 
                'city' => $_GET['city_name'], 
                'state' => $_GET['state_name'], 
                'country' => $_GET['country_name'], 
                'zipcode' => $_GET['zip_code_name'], 
                'phone_number' => $_GET['phone_number'], 
                'email_address' => $_GET['email_name'], 
                'created_at' => date('Y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insert_arr2 = [
                'final_checkout_id' => $final_check_id, 
                'final_checkout_session_id' => $get_session_data, 
                'f_name' => $_GET['first_name2'], 
                'l_name' => $_GET['last_name2'], 
                'company_name' => $_GET['company_name2'], 
                'street1_address' => $_GET['street1_name2'], 
                'street2_address' => $_GET['street2_name2'], 
                'city' => $_GET['city_name2'], 
                'state' => $_GET['state_name2'], 
                'country' => $_GET['country_name2'], 
                'zipcode' => $_GET['zip_code_name2'], 
                'created_at' => date('Y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insertQuery1 = Billing_Model::insert($insertArr);
            $insertQuery2 = Shipping_Model::insert($insert_arr2);
            if($insertQuery1)
            {
                $msg_status = "success";
            }
            else
            {
                $msg_status = "error";
            }

            echo json_encode($msg_status);
        }
        else if($_GET['pay_state_status'] == "no")
        {
            if($request->session()->has('main_unique_session_key'))
            {
                $get_session_data = $request->session()->get('main_unique_session_key');
            }
            $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
            foreach($mainQuery as $mQuery)
            {
                $final_check_id  = $mQuery->id;
            }
            $insertArr = [
                'final_checkout_id' => $final_check_id, 
                'final_checkout_session_id' => $get_session_data, 
                'f_name' => $_GET['first_name'], 
                'l_name' => $_GET['last_name'], 
                'company_name' => $_GET['company_name'], 
                'street1_address' => $_GET['street1_name'], 
                'street2_address' => $_GET['street2_name'], 
                'city' => $_GET['city_name'], 
                'state' => $_GET['state_name'], 
                'country' => $_GET['country_name'], 
                'zipcode' => $_GET['zip_code_name'], 
                'phone_number' => $_GET['phone_number'], 
                'email_address' => $_GET['email_name'], 
                'created_at' => date('Y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insert_arr2 = [
                'final_checkout_id' => $final_check_id, 
                'final_checkout_session_id' => $get_session_data, 
                'f_name' => $_GET['first_name'], 
                'l_name' => $_GET['last_name'], 
                'company_name' => $_GET['company_name'], 
                'street1_address' => $_GET['street1_name'], 
                'street2_address' => $_GET['street2_name'], 
                'city' => $_GET['city_name'], 
                'state' => $_GET['state_name'], 
                'country' => $_GET['country_name'], 
                'zipcode' => $_GET['zip_code_name'], 
                'created_at' => date('Y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];
            $insertQuery1 = Billing_Model::insert($insertArr);
            $insertQuery2 = Shipping_Model::insert($insert_arr2);
            if($insertQuery1)
            {
                $msg_status = "success";
            }
            else
            {
                $msg_status = "error";
            }
            echo json_encode($msg_status);
        }
    }
}
