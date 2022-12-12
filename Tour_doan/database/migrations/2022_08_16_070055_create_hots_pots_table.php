<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotsPotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hots_pots', function (Blueprint $table) {
            $table->id();
            // hotspot default
            $table->string('name')->nullable();
            $table->string('html')->nullable();
            $table->float('ath')->nullable();
            $table->float('atv')->nullable();
            $table->string('style')->nullable();
            $table->string('distorted')->nullable();
            $table->string('zoom')->nullable();
            $table->string('url')->nullable();

            // hotspot iframe
            $table->float('x')->nullable();
            $table->float('y')->nullable();
            $table->float('z')->nullable();
            $table->string('renderer')->nullable();
            $table->float('scale')->nullable();
            $table->float('alpha')->nullable();

            // event
            $table->string('onload')->nullable();
            $table->string('onloaded')->nullable();
            $table->string('onhover')->nullable();
            $table->string('onclick')->nullable();
            $table->string('linkedscene')->nullable();

            $table->unsignedBigInteger('pano_id')->unsigned()->nullable();
            $table->foreign('pano_id')->references('id')->on('panos')->onDelete('cascade');

            $table->unsignedBigInteger('category_hotspot_id')->unsigned()->nullable();
            $table->bigInteger('id_priority')->nullable();
            $table->unsignedBigInteger('icon_id')->unsigned()->nullable();
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
        Schema::dropIfExists('hots_pots');
    }
}
