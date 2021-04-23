<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    //
    protected $table = "footers";

    protected $fillable = [
        'contact_number', 'contact_email', 'facebook_link', 'twitter_link', 'created_at', 'updated_at'
    ];
}
