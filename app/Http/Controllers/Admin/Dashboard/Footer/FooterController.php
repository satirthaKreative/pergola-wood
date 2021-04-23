<?php

namespace App\Http\Controllers\Admin\Dashboard\Footer;

use App\Model\Admin\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function showCmsFooter()
    {
        return view('backend.pages.cms-footer');
    }

    public function showAddCmsFooter(Request $request)
    {
        return view('backend.pages.add-cms-footer');
    }

    public function allFooter()
    {
        $mainQuery = Footer::all();
        $data = "";
        if(count($mainQuery) > 0)
        {
            $i = 1;
            foreach($mainQuery as $mQ)
            {
                $data .= '<tr><td>'.$i.'</td><td>'.$mQ->contact_number.'</td><td>'.$mQ->contact_email.'</td><td>'.$mQ->facebook_link.'</td><td>'.$mQ->twitter_link.'</td></tr>';
                $i++;
            }
        }
        else
        {
            $data .= "<tr><td colspan='5'><center class='text-danger'><i class='fa fa-times'></i> No details added before!</center></td></tr>";
        }

        echo  json_encode($data);
    }

    public function countFooter(Request $request)
    {
        $rQuery = Footer::all();

        if(count($rQuery) > 0)
        {
            $data = "success";
        }
        else
        {
            $data = "error";
        }

        echo json_encode($data);
    }

    public function footerCmsSubmit(Request $request)
    {
        $insertArr = [
          'contact_number' => $request->input('contact_number'),
          'contact_email' => $request->input('contact_email'),
          'facebook_link' => $request->input('fb_link'),
          'twitter_link' => $request->input('tw_link'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s') 
        ];
        
        $insertQuery = Footer::where('id',1)->update($insertArr);
        $request->session()->flash('success_msg', 'Successfully Updated!');

        return back()->withMessage('success');
    }

    public function updateFooter(Request $request)
    {
        $mainQuery = Footer::all();
        echo json_encode($mainQuery);
    }
}
