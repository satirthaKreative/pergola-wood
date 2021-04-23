<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickPostLengthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_post_length_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('posts_length')->nullable();
            $table->float('price_details',8,2)->nullable();
            $table->longText('img_file')->nullable();
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
        Schema::dropIfExists('pick_post_length_tbls');
    }
}
