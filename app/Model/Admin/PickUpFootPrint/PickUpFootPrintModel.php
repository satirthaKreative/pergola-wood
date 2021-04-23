<?php

namespace App\Model\Admin\PickUpFootPrint;

use Illuminate\Database\Eloquent\Model;

class PickUpFootPrintModel extends Model
{
    //
    protected $table = "pickup_footprint_tbls";

    protected $fillable = [
        'height_master', 'width_master', 'posts_master', 'price_master', 'img_master', 'admin_action', 'created_at', 'updated_at'
    ];
}
