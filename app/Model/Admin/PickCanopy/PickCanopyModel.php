<?php

namespace App\Model\Admin\PickCanopy;

use Illuminate\Database\Eloquent\Model;

class PickCanopyModel extends Model
{
    //
    protected $table = "pick_canopy_tbls";

    protected $fillable = [
        'canopy_question', 'canopy_note', 'canopy_price', 'admin_action', 'created_at', 'updated_at'
    ];
}
