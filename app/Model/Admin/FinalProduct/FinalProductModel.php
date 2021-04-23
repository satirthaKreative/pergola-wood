<?php

namespace App\Model\Admin\FinalProduct;

use Illuminate\Database\Eloquent\Model;

class FinalProductModel extends Model
{
    //
    protected $table = "final_product_tbls";

    protected $fillable = [
        'pick_footprint', 'final_product_img', 'final_footprint_img', 'admin_action', 'created_at', 'updated_at'
    ];
}