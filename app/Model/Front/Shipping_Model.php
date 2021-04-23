<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class Shipping_Model extends Model
{
    //
    protected $table = "shipping_address_tbls";

    protected $fillable = [
        'final_checkout_id', 'final_checkout_session_id', 'f_name', 'l_name', 'company_name', 'street1_address', 'street2_address', 'city', 'state', 'country', 'zipcode', 'created_at', 'updated_at'
    ];
}
