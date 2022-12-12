<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voice_contents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('voice')->nullable();
            $table->string('type_voice')->nullable();
            $table->string('type')->nullable();
            $table->boolean('state')->default(false)->nullable();
            $table->unsignedBigInteger('content_id')->unsigned()->nullable();
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->unsignedBigInteger('infor_id')->unsigned()->nullable();
            $table->foreign('infor_id')->references('id')->on('infor_tours')->onDelete('cascade');
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
        Schema::dropIfExists('voice_contents');
    }
}
