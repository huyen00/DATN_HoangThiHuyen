<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('video')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_vn')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->foreign('hotspot_id')->references('id')->on('hots_pots')->onDelete('cascade');
            $table->unsignedBigInteger('hotspot_id')->unsigned()->nullable();
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
        Schema::dropIfExists('contents');
    }
}
