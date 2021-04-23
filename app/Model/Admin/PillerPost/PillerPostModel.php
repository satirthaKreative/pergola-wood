<?php

namespace App\Model\Admin\PillerPost;

use Illuminate\Database\Eloquent\Model;

class PillerPostModel extends Model
{
    //
    protected $table = "piller_post_tbls";

    protected $fillable = [
        'no_of_posts', 'admin_action', 'created_at', 'updated_at'
    ];
}
