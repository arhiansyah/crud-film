<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_information', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('title_alt', 100);
            $table->string('slug', 255);
            $table->string('video_code');
            $table->string('genre');
            $table->string('author');
            $table->string('studio');
            $table->integer('category_video');
            $table->longText('description');
            $table->string('tag');
            $table->string('tahunFilm');
            $table->integer('rating');
            $table->string('thumbnail')->nullable();
            $table->integer('video_id');
            $table->integer('channel_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_information');
    }
};
