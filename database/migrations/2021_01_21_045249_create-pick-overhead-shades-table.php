<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickOverheadShadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_overhead_shades_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_standard_name')->nullable();
            $table->float('price_details',8,2)->nullable();
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
        Schema::dropIfExists('pick_overhead_shades_tbls');
    }
}
