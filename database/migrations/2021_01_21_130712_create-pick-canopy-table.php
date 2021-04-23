<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickCanopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_canopy_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('canopy_question')->nullable();
            $table->longText('canopy_note')->nullable();
            $table->float('canopy_price',8,2);
            $table->enum('admin_action',['yes','no'])->default('yes');
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
        Schema::dropIfExists('pick_canopy_tbls');
    }
}
