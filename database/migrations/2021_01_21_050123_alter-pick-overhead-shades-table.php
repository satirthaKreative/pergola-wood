<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPickOverheadShadesTable extends Migration
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
            $table->longText('img_file')->after('price_details')->nullable();
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
