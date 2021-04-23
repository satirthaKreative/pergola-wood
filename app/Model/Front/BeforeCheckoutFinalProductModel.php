<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class BeforeCheckoutFinalProductModel extends Model
{
    //
    protected $table = "final_before_checkout_product_tbl";

    protected $fillable = [
        'final_width', 'final_length', 'final_no_posts', 'final_overhead', 'final_post_length', 'final_post_mount_type', 'final_post_mount', 'final_canopy_type', 'final_canopy', 'final_lpanel_type', 'final_product_id', 'final_lpanel', 'final_price', 'unique_session_id', 'pay_status', 'admin_action', 'created_at', 'updated_at'
    ];
}
