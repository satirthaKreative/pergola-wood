<?php

namespace App\Model\Admin\PickLouveredPanel;

use Illuminate\Database\Eloquent\Model;

class PickLouveredPanelModel extends Model
{
    //
    protected $table = "pick_louvered_panel_tbls";

    protected $fillable = [
        'l_panel_name', 'l_panel_price', 'admin_action', 'created_at', 'updated_at'
    ];
}
