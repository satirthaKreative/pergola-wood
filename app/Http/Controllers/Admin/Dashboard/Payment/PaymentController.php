<?php

namespace App\Http\Controllers\Admin\Dashboard\Payment;

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

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showpage(Request $request)
    {
        return view('backend.pages.payment-order-details.pay-order-details');
    }

    public function showActionPage(Request $request)
    {
        $mainQuery = PaymentModel::get();
        if(count($mainQuery) > 0){
            $html['order_details'] = "";
            $i = 0;
            foreach($mainQuery as $mQuery)
            {

                $billingQuery = Billing_Model::where('final_checkout_session_id',$mQuery->user_id)->get();
                foreach($billingQuery as $billQuery)
                {
                    $user_name = $billQuery->f_name." ".$billQuery->l_name; 
                }
                
                $html['order_details'] .= '<tr>
                <td>'.++$i.'</td>
                <td>'.$mQuery->order_details_id.'</td>
                <td>'.$user_name.'</td>
                <td>User Price</td>
                <td>'.$mQuery->pay_flow_status.'</td>
                <td>
                    <select name="order_details_status" id="order_details_status'.$mQuery->id.'" onchange=order_details_status_fx('.$mQuery->id.')>
                        <option value="processing">processing</option>
                        <option value="shippment">shippment</option>
                        <option value="success">success</option>
                    </select>
                </td>
              </tr>';
            }
        }
        echo json_encode($html);
    }


    public function changeAction(Request $request)
    {
        $billingQuery = PaymentModel::where('id',$_GET['id'])->update(['pay_flow_status' => $_GET['order_details_status']]);

        if($billingQuery)
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
