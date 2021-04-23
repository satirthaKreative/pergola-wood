<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinationTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combination_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('combination_id');
            $table->float('existing_price');
            $table->float('new_price');
            $table->text('canopy_list');
            $table->float('canopy_price');
            $table->float('left_price');
            $table->float('right_price');
            $table->float('rear_price');
            $table->float('left_rear_price');
            $table->float('right_rear_price');
            $table->float('left_right_rear_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combination_tbl');
    }
}
