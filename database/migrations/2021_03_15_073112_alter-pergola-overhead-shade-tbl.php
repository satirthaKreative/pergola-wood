<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPergolaOverheadShadeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pick_overhead_shades_tbls', function (Blueprint $table) {
            //
            $table->bigInteger('master_width')->after('img_standard_name');
            $table->bigInteger('master_height')->after('master_width');
            $table->bigInteger('master_post')->after('master_height');
            $table->bigInteger('master_overhead_shades')->after('master_post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pick_overhead_shades_tbls', function (Blueprint $table) {
            //
        });
    }
}
