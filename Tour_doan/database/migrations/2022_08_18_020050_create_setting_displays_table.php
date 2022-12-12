<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_displays', function (Blueprint $table) {
            $table->id();
            $table->boolean('sound')->default(true)->nullable();
            $table->boolean('share')->default(true)->nullable();
            $table->boolean('back_scene')->default(true)->nullable();
            $table->boolean('fullscreen')->default(true)->nullable();
            $table->boolean('infor')->default(true)->nullable();
            $table->boolean('setting_map')->default(true)->nullable();
            $table->boolean('guide')->default(true)->nullable();
            $table->boolean('show_hotspot')->default(true)->nullable();
            $table->boolean('rotate')->default(true)->nullable();
            $table->boolean('setting_vr')->default(true)->nullable();
            $table->boolean('contact')->default(true)->nullable();
           
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
        Schema::dropIfExists('setting_displays');
    }
}
