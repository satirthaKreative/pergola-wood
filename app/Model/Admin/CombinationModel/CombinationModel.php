<?php

namespace App\Model\Admin\CombinationModel;

use Illuminate\Database\Eloquent\Model;

class CombinationModel extends Model
{
    //

    protected $table = "combination_tbl";

    protected $fillable = [
        'combination_id', 'existing_price', 'new_price', 'canopy_list', 'canopy_price', 'left_price', 'right_price', 'rear_price', 'left_rear_price', 'right_rear_price', 'left_right_rear_price', 'created_at', 'updated_at'
    ];
}
