<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('thumb_img')->nullable();
            $table->string('id_thumb')->nullable();
            $table->string('path_onstart')->nullable();
            $table->unsignedBigInteger('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->unsignedBigInteger('category_pano_id')->unsigned()->nullable();
            $table->bigInteger('id_priority')->nullable();
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
        Schema::dropIfExists('panos');
    }
}
