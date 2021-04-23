<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickupFootprintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_footprint_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('height_master', 8, 2);
            $table->float('width_master', 8, 2);
            $table->bigInteger('posts_master');
            $table->longText('img_master')->nullable();
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
        Schema::dropIfExists('pickup_footprint_tbls');
    }
}
