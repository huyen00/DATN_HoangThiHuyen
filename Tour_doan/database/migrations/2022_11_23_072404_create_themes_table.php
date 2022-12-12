<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
            Schema::create('themes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->unique()->nullable();
                $table->string('image_template')->nullable();
                $table->string('link_code');
                $table->tinyInteger('type')->default(0);
                // $table->unsignedBigInteger('category_id')->nullable();
                // $table->foreign('category_id')->references('id')->on('category_themes')->onDelete('cascade');
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
        Schema::dropIfExists('themes');
    }
}
