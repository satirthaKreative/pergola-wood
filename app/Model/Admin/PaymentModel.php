<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    //
    protected $table = "order_payment_tbl";

    protected $fillable = [
        'order_details_id', 'user_id', 'pay_state', 'pay_flow_status', 'admin_status'
    ];
}
