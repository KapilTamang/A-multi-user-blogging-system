<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('id');
            $table->string('slug')->unique()->index()->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('title');
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();
            $table->string('featured_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */ 
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
