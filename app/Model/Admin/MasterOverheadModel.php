<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class MasterOverheadModel extends Model
{
    //
    protected $table = "overhead_shades_tbl";

    protected $fillable = [
        'overhead_shades_val','admin_action'
    ];
    
}
