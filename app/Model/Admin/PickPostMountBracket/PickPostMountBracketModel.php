<?php

namespace App\Model\Admin\PickPostMountBracket;

use Illuminate\Database\Eloquent\Model;

class PickPostMountBracketModel extends Model
{
    protected $table = "pick_slap_tbls";

    protected $fillable = [
        'pick_slap_name', 'price_details', 'admin_action', 'created_at', 'updated_at'
    ];
}
