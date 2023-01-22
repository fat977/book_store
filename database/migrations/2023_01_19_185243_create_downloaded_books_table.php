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
        Schema::create('downloaded_books', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->integer('category_id');
            $table->string('book_name');
            $table->string('book_image');
            $table->string('language');
            $table->string('size');
            $table->string('No_pages');
            $table->string('file');
            $table->string('file_type');
            $table->string('description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
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
        Schema::dropIfExists('downloaded_books');
    }
};
