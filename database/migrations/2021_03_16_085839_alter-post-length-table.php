<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostLengthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pick_post_length_tbls', function (Blueprint $table) {
            $table->bigInteger('master_width')->after('posts_length');
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
        Schema::table('pick_post_length_tbls', function (Blueprint $table) {
            //
        });
    }
}
