<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_colors', function (Blueprint $table) {
            $table->id();
            //icon
            $table->string('icon_color')->nullable();
            $table->string('bg_icon_color')->nullable();
            $table->string('hover_color_icon')->nullable();
            $table->string('hover_bg_icon_color')->nullable();
            $table->string('active_icon_color')->nullable();
            $table->string('active_bg_icon_color')->nullable();
            //sider_bar
            $table->string('bg_menu_color')->nullable();
            $table->string('bg_color_category')->nullable();
            $table->string('color_category')->nullable();
            $table->string('color_item')->nullable();
            $table->string('hover_color_item')->nullable();
            $table->string('active_color_item')->nullable();
            $table->unsignedBigInteger('tour_id')->unique()->unsigned()->nullable();
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
        Schema::dropIfExists('setting_colors');
    }
}
