<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class UniqueUsers extends Model
{
    //

    protected $table = "uniqueusers";

    protected $fillable = [
        'visitors', 'created_at', 'updated_at'
    ];
}
