<?php

namespace App\Model\Admin\MasterHeight;

use Illuminate\Database\Eloquent\Model;

class MasterHeightModel extends Model
{
    //
    protected $table = "master_height_tbls";

    protected $fillable = [
        'master_height_length', 'admin_action', 'created_at', 'updated_at'
    ];
}
