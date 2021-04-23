<?php

namespace App\Model\Admin\MasterPostLength;

use Illuminate\Database\Eloquent\Model;

class MasterPostLengthModel extends Model
{
    //
    protected $table = 'master_post_length_tbl';

    protected $fillable = [
        'master_post_length', 'admin_action', 'created_at', 'updated_at'
    ];
}
