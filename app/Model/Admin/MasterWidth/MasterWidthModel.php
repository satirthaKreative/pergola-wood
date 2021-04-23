<?php

namespace App\Model\Admin\MasterWidth;

use Illuminate\Database\Eloquent\Model;

class MasterWidthModel extends Model
{
    //
    protected $table = "master_width_tbls";

    protected $fillable = [
        'master_width_length', 'admin_action', 'created_at', 'updated_at'
    ];
}
