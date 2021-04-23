<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class Billing_Model extends Model
{
    //
    protected $table = "billing_address_tbls";

    protected $fillable = [
        'final_checkout_id', 'final_checkout_session_id', 'f_name', 'l_name', 'company_name', 'street1_address', 'street2_address', 'city', 'state', 'country', 'zipcode', 'phone_number', 'email_address', 'created_at', 'updated_at'
    ];
}
