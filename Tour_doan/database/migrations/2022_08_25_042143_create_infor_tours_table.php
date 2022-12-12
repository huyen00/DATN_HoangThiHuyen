<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInforToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infor_tours', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_priority')->nullable();
            $table->string('title')->nullable();
            $table->longText('description_vn')->nullable();
            $table->longText('description_en')->nullable();
            $table->unsignedBigInteger('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
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
        Schema::dropIfExists('infor_tours');
    }
}
